<?php
return[
  'name' => 'dpnblog',

  'main' => function(){

  },

  'autoload' => ['Pastheme\\Blog\\' => 'src'],

  'permissions' => [
    'dpnblog: manage all categorys' => [
        'title' => 'Manage all categorys',
        'description' => 'Create, edit, delete and publish your own categories'
    ],
    'dpnblog: manage own posts' => [
        'title' => 'Manage own posts',
        'description' => 'Create, edit, delete and publish your own blog posts'
    ],
    'dpnblog: manage all posts' => [
        'title' => 'Manage all posts',
        'description' => 'Create, edit, delete and publish blog posts from all authors'
    ],
    'dpnblog: manage comments' => [
        'title' => 'Manage comments',
        'description' => 'Approve, edit and delete comments'
    ],
    'dpnblog: post comments' => [
        'title' => 'Post comments',
        'description' => 'Settings for comments function on the site'
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

  'routes' => [
    '/dpnblog' => [
      'name' => '@dpnblog',
      'controller' => [
        'Pastheme\\Blog\\Controller\\BlogController'
      ]
    ],
  ],

  'menu' => [
    'dpnblog' => [
      'label'     => 'Blog',
      'icon'      => 'dpnblog:icon.svg',
      'url'       => '@dpnblog/post',
      'active'    => '@dpnblog/post*',
      'access'    => 'dpnblog: manage all categorys',
      'priority'  => 110
    ],
    'dpnblog: category' => [
      'label'     => 'Categorys',
      'parent'    => 'dpnblog',
      'url'       => '@dpnblog/category',
      'active'    => '@dpnblog/category*',
      'access'    => ''
    ],
  ],

]
?>
