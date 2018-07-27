<?php

namespace Pastheme\Blog\Controller;
use Pagekit\Application as App;
use Pastheme\Blog\Model\Category;
use Pastheme\Blog\Model\Post;

class CategoryController{

  /**
   * @var Module
   */
  protected $blog;

  /**
   * Constructor.
   */
  public function __construct()
  {
      $this->blog = App::module('dpnblog');
  }

  /**
  * @Route("/{id}" , name="id" , requirements={"page" = "\d+"})
  * @Request({"page": "int"})
  */
  public function indexAction($page = 1 , $id = null){

    if (empty($id) || !$category = Category::query()->where('id = ?' , [$id])->first()) {
      App::abort(404 , 'Category Not Found');
    }

    $query = Post::where(['status = ?', 'date < ?' , 'category_id = ?'], [Post::STATUS_PUBLISHED, new \DateTime , $category->id])->where(function ($query) {
        return $query->where('roles IS NULL')->whereInSet('roles', App::user()->roles, false, 'OR');
    })->related(['user' , 'category']);

    if (!$limit = $this->blog->config('posts.posts_per_page')) {
        $limit = 10;
    }

    $count = $query->count('id');
    $total = ceil($count / $limit);
    $page = max(1, min($total, $page));

    $query->offset(($page - 1) * $limit)->limit($limit)->orderBy('date', 'DESC');

    foreach ($posts = $query->get() as $post) {
        $post->excerpt = App::content()->applyPlugins($post->excerpt, ['post' => $post, 'markdown' => $post->get('markdown')]);
        $post->content = App::content()->applyPlugins($post->content, ['post' => $post, 'markdown' => $post->get('markdown'), 'readmore' => true]);
    }

    if (isset($category->data['meta']['og:description'])) {
      $description = $category->data['meta']['og:description'];
    }else{
      $description = '';
    }

    if (isset($category->data['meta']['og:title'])) {
      $title = $category->data['meta']['og:title'];
    }else{
      $title = $category->title;
    }

    return [
        '$view' => [
            'title' => __('Blog'),
            'name' => 'dpnblog/category.php',
            'link:feed' => [
                'rel' => 'alternate',
                'href' => App::url('@dpnblog/feed'),
                'title' => App::module('system/site')->config('title'),
                'type' => App::feed()->create($this->blog->config('feed.type'))->getMIMEType(),
            ],
            'og:title' => $title,
            'og:description' => $description,
        ],
        'category'  => $id,
        'blog'      => $this->blog,
        'posts'     => $posts,
        'total'     => $total,
        'page'      => $page
    ];

  }

}

?>
