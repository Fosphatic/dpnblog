<?php

use Pastheme\Blog\Content\ReadmorePlugin;
use Pastheme\Blog\Event\PostListener;
use Pastheme\Blog\Event\RouteListener;
use Pastheme\Blog\Event\CategoryRouteListener;

return [

    'name' => 'dpnblog',

    'autoload' => [

        'Pastheme\\Blog\\' => 'src'

    ],

    'nodes' => [

        'dpnblog' => [
            'name' => '@dpnblog',
            'label' => 'Blog',
            'controller' => 'Pastheme\\Blog\\Controller\\SiteController',
            'protected' => true,
            'frontpage' => true
        ]

    ],

    'routes' => [

        '/dpnblog' => [
            'name' => '@dpnblog',
            'controller' => [
              'Pastheme\\Blog\\Controller\\BlogController'
            ]
        ],
        '/category' => [
            'name' => '@blogcategory',
            'controller' => 'Pastheme\\Blog\\Controller\\CategoryController'
        ],
        '/tags' => [
            'name' => '@blogcategory',
            'controller' => 'Pastheme\\Blog\\Controller\\TagsController'
        ],
        '/api/dpnblog' => [
            'name' => '@dpnblog/api',
            'controller' => [
                'Pastheme\\Blog\\Controller\\PostApiController',
                'Pastheme\\Blog\\Controller\\CategoryApiController',
                'Pastheme\\Blog\\Controller\\CommentApiController',
                'Pastheme\\Blog\\Controller\\ApiComponentController'
            ]
        ]

    ],

    'permissions' => [

        'dpnblog: manage own posts' => [
            'title' => 'Manage own posts',
            'description' => 'Create, edit, delete and publish posts of their own'
        ],
        'dpnblog: manage all posts' => [
            'title' => 'Manage all posts',
            'description' => 'Create, edit, delete and publish posts by all users'
        ],
        'dpnblog: manage comments' => [
            'title' => 'Manage comments',
            'description' => 'Approve, edit and delete comments'
        ],
        'dpnblog: post comments' => [
            'title' => 'Post comments',
            'description' => 'Allowed to write comments on the site'
        ],
        'dpnblog: skip comment approval' => [
            'title' => 'Skip comment approval',
            'description' => 'User can write comments without admin approval'
        ],
        'dpnblog: comment approval required once' => [
            'title' => 'Comment approval required only once',
            'description' => 'First comment needs to be approved, later comments are approved automatically'
        ],
        'dpnblog: skip comment min idle' => [
            'title' => 'Skip comment minimum idle time',
            'description' => 'User can write multiple comments without having to wait in between'
        ]

    ],

    'menu' => [

        'dpnblog' => [
            'label' => 'Blog',
            'icon' => 'dpnblog:icon.svg',
            'url' => '@dpnblog/post',
            'active' => '@dpnblog/post*',
            'access' => 'dpnblog: manage own posts || dpnblog: manage all posts || dpnblog: manage comments || system: access settings',
            'priority' => 110
        ],
        'dpnblog: posts' => [
            'label' => 'Posts',
            'parent' => 'dpnblog',
            'url' => '@dpnblog/post',
            'active' => '@dpnblog/post*',
            'access' => 'dpnblog: manage own posts || dpnblog: manage all posts'
        ],
        'dpnblog: category' => [
            'label' => 'Category',
            'parent' => 'dpnblog',
            'url' => '@dpnblog/category',
            'active' => '@dpnblog/category*',
            'access' => 'system: access settings'
        ],
        'dpnblog: comments' => [
            'label' => 'Comments',
            'parent' => 'dpnblog',
            'url' => '@dpnblog/comment',
            'active' => '@dpnblog/comment*',
            'access' => 'dpnblog: manage comments'
        ],
        'dpnblog: settings' => [
            'label' => 'Settings',
            'parent' => 'dpnblog',
            'url' => '@dpnblog/settings',
            'active' => '@dpnblog/settings*',
            'access' => 'system: access settings'
        ]

    ],

    'settings' => '@dpnblog/settings',

    'config' => [

        'share' => [
          'active'  => true,
          'model'   => 'default'
        ],

        'like'  => true,

        'comments' => [

            'autoclose' => false,
            'autoclose_days' => 14,
            'blacklist' => '',
            'comments_per_page' => 20,
            'gravatar' => true,
            'max_depth' => 5,
            'maxlinks' => 2,
            'minidle' => 120,
            'nested' => true,
            'notifications' => 'always',
            'order' => 'ASC',
            'replymail' => true,
            'require_email' => true

        ],

        'posts' => [

            'posts_per_page' => 20,
            'comments_enabled' => true,
            'markdown_enabled' => true

        ],

        'permalink' => [
            'type' => '',
            'custom' => '{slug}'
        ],

        'feed' => [
            'type' => 'rss2',
            'limit' => 20
        ],

        'icons' => ['pagekit' , 'linux']

    ],

    'events' => [

        'boot' => function ($event, $app) {
            $app->subscribe(
                new RouteListener,
                new CategoryRouteListener,
                new PostListener(),
                new ReadmorePlugin
            );

        },

        'view.scripts' => function ($event, $scripts) {
            $scripts->register('link-blog', 'dpnblog:app/bundle/link-blog.js', '~panel-link');
            $scripts->register('post-meta', 'dpnblog:app/bundle/post-meta.js', '~post-edit');
        },
        'site' => function ($event, $app) {
            $app->on('view.content', function ($event, $test) use ($app) {
            $app['scripts']->add('highlight-js' , 'dpnblog:assets/highlight/highlight.pack.js' , ['jquery']);
            $app['scripts']->add('highlight-init' , 'dpnblog:assets/highlight/highlight.init.js' , 'highlight-js');
            $app['styles']->add('highlight-css' , 'dpnblog:assets/highlight/styles/atom-one-dark.css');
            });
        }
    ]

];
