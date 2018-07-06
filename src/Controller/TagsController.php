<?php

namespace Pastheme\Blog\Controller;
use Pagekit\Application as App;
use Pastheme\Blog\Model\Category;
use Pastheme\Blog\Model\Post;

class TagsController{

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
  * @Route("/{tags}" , name="tags" , requirements={"page" = "\d+"})
  * @Request({"page": "int" , "tags":"string"})
  */
  public function indexAction($page = 1 , $tags = null){

    if (empty($tags)) {
      App::abort('404' , 'Not Found Tags');
    }

    $sqlTags = Post::where(["status = :status", "date < :date" , "tags LIKE :search"] , [":status" => Post::STATUS_PUBLISHED, ":date" => new \DateTime  , ":search" => "%{$tags}%"])->where(function ($sqlTags) {
        return $sqlTags->where('roles IS NULL')->whereInSet('roles', App::user()->roles, false, 'OR');
    })->related(['user' , 'category']);

    if (!$limit = $this->blog->config('posts.posts_per_page')) {
        $limit = 10;
    }

    $count = $sqlTags->count('id');
    $total = ceil($count / $limit);
    $page = max(1, min($total, $page));

    $sqlTags->offset(($page - 1) * $limit)->limit($limit)->orderBy('date', 'DESC');

    foreach ($posts = $sqlTags->get() as $post) {
        $post->excerpt = App::content()->applyPlugins($post->excerpt, ['post' => $post, 'markdown' => $post->get('markdown')]);
        $post->content = App::content()->applyPlugins($post->content, ['post' => $post, 'markdown' => $post->get('markdown'), 'readmore' => true]);
    }

    if (empty($posts)) {
      App::abort('404' , 'Not Found Tags');
    }

    return [
        '$view' => [
            'title' => __('Blog'),
            'name' => 'dpnblog/posts.php',
            'link:feed' => [
                'rel' => 'alternate',
                'href' => App::url('@dpnblog/feed'),
                'title' => App::module('system/site')->config('title'),
                'type' => App::feed()->create($this->blog->config('feed.type'))->getMIMEType()
            ]
        ],
        'blog' => $this->blog,
        'posts' => $posts,
        'total' => $total,
        'page' => $page
    ];

  }

}

?>
