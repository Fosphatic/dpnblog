<?php

namespace Pastheme\Blog\Controller;

use Pagekit\Application as App;
use Pastheme\Blog\Model\Comment;
use Pastheme\Blog\Model\Post;
use Pagekit\User\Model\Role;
use Pastheme\Blog\Model\Category;
use Pastheme\Blog\Conf\GeneralConf;

/**
 * @Access(admin=true)
 */
class BlogController extends GeneralConf
{
    /**
     * @Access("dpnblog: manage own posts || dpnblog: manage all posts")
     * @Request({"filter": "array", "page":"int"})
     */
    public function postAction($filter = null, $page = null)
    {
        return [
            '$view' => [
                'title' => __('Posts'),
                'name'  => 'dpnblog/admin/post-index.php'
            ],
            '$data' => [
                'statuses' => Post::getStatuses(),
                'authors'  => Post::getAuthors(),
                'canEditAll' => App::user()->hasAccess('dpnblog: manage all posts'),
                'config'   => [
                    'filter' => (object) $filter,
                    'page'   => $page
                ]
            ]
        ];
    }

    /**
     * @Route("/post/edit", name="post/edit")
     * @Access("dpnblog: manage own posts || dpnblog: manage all posts")
     * @Request({"id": "int"})
     */
    public function editAction($id = 0)
    {
        try {

            if (!$post = Post::where(compact('id'))->related('user')->first()) {

                if ($id) {
                    App::abort(404, __('Invalid post id.'));
                }

                $module = App::module('dpnblog');

                $post = Post::create([
                    'user_id' => App::user()->id,
                    'status' => Post::STATUS_DRAFT,
                    'date' => new \DateTime(),
                    'comment_status' => (bool) $module->config('posts.comments_enabled'),
                    'tags' => []
                ]);

                $post->set('title', $module->config('posts.show_title'));
                $post->set('markdown', $module->config('posts.markdown_enabled'));
            }

            $user = App::user();
            if(!$user->hasAccess('dpnblog: manage all posts') && $post->user_id !== $user->id) {
                App::abort(403, __('Insufficient User Rights.'));
            }

            $category = App::db()->createQueryBuilder()
              ->from('@dpnblog_category')
              ->where(['status' => 2])
              ->get();

            $roles = App::db()->createQueryBuilder()
                ->from('@system_role')
                ->where(['id' => Role::ROLE_ADMINISTRATOR])
                ->whereInSet('permissions', ['dpnblog: manage all posts', 'dpnblog: manage own posts'], false, 'OR')
                ->execute('id')
                ->fetchAll(\PDO::FETCH_COLUMN);

            $authors = App::db()->createQueryBuilder()
                ->from('@system_user')
                ->whereInSet('roles', $roles)
                ->execute('id, username')
                ->fetchAll();

            return [
                '$view' => [
                    'title' => $id ? __('Edit Post') : __('Add Post'),
                    'name'  => 'dpnblog/admin/post-edit.php'
                ],
                '$data' => [
                    'post'     => $post,
                    'statuses' => Post::getStatuses(),
                    'roles'    => array_values(Role::findAll()),
                    'canEditAll' => $user->hasAccess('dpnblog: manage all posts'),
                    'authors'  => $authors,
                    'category' => $category
                ],
                'post' => $post
            ];

        } catch (\Exception $e) {

            App::message()->error($e->getMessage());

            return App::redirect('@dpnblog/post');
        }
    }

    /**
     * @Access("dpnblog: manage comments")
     * @Request({"filter": "array", "post":"int", "page":"int"})
     */
    public function commentAction($filter = [], $post = 0, $page = null)
    {
        $post = Post::find($post);
        $filter['order'] = 'created DESC';

        return [
            '$view' => [
                'title' => $post ? __('Comments on %title%', ['%title%' => $post->title]) : __('Comments'),
                'name'  => 'dpnblog/admin/comment-index.php'
            ],
            '$data'   => [
                'statuses' => Comment::getStatuses(),
                'config'   => [
                    'filter' => (object) $filter,
                    'page'   => $page,
                    'post'   => $post,
                    'limit'  => App::module('dpnblog')->config('comments.comments_per_page')
                ]
            ]
        ];
    }

    /**
     * @Access("system: access settings")
     */
    public function settingsAction()
    {
        return [
            '$view' => [
                'title' => __('Blog Settings'),
                'name'  => 'dpnblog/admin/settings.php'
            ],
            '$data' => [
                'config' => App::module('dpnblog')->config()
            ]
        ];
    }

    /**
     * @Access("system: access settings")
     * @Route("/category" , name="/category")
     * @Request({"sub": "int"})
     */
    public function categoryAction($sub = 0)
    {
        if ($sub === 0) {
          $query = Category::query()->where('sub_category IS NULL')->orderBy('id' , 'ASC')->get();
        }else{
          $query = Category::query()->where('sub_category LIKE :search' , [':search' => "%{$sub}%"])->orderBy('id' , 'ASC')->get();
        }


        return [
            '$view' => [
                'title' => $sub >= 1 ? __('Sub Categories'):__('Categories'),
                'name'  => 'dpnblog/admin/category-index.php'
            ],
            '$data' => [
                'category' => $query,
                'sub'       => $sub
            ],
            'categories' => $sub >= 1 ? __('Sub Categories'):__('Categories'),
        ];
    }

    /**
     * @Route("/category/edit", name="category/edit")
     * @Access("dpnblog: manage own posts || dpnblog: manage all posts")
     * @Request({"id": "int"})
     */
    public function categoryEditAction($id = 0){
      try {

        if (!$category = Category::where(compact('id'))->first()) {

          if ($id) {
              App::abort(404, __('Invalid category id.'));
          }

          $category = Category::create([
            'status'  => 2,
            'data'  => [
              'meta' => [
                'og:title' => ''
              ]
            ]
          ]);
        }

        if (!$others = array_values(Category::query()->where(['status = ?' , 'id != ?' , 'sub_category IS NULL'] , [2 , $id])->orderBy('sub_category' , 'ASC')->get())) {
          $others = [];
        }

        if (!is_array($category->sub_category)) {
          $category->sub_category = [];
        }

        $icons = App::module('dpnblog');

        return [
          '$view' => [
            'title' => $id == 0 ? __('New Category'):__('Edit Category'),
            'name'  => 'dpnblog:views/admin/category-edit.php'
          ],
          '$data' => [
            'category'  => $category,
            'other'     => $others,
            'icons'     => $icons->config['icons']
          ]
        ];

      } catch (\Exception $e) {

          App::message()->error($e->getMessage());

          return App::redirect('@dpnblog/category');
      }

    }

}
