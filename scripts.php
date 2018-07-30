<?php
return [

    'install' => function ($app) {
      $util = $app['db']->getUtility();
      if ($util->tableExists('@dpnblog_post') === false) {
          $util->createTable('@dpnblog_post', function ($table) {
              $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
              $table->addColumn('user_id', 'integer', ['unsigned' => true, 'length' => 10, 'default' => 0]);
              $table->addColumn('slug', 'string', ['length' => 255]);
              $table->addColumn('title', 'string', ['length' => 255]);
              $table->addColumn('status', 'smallint');
              $table->addColumn('date', 'datetime', ['notnull' => false]);
              $table->addColumn('modified', 'datetime');
              $table->addColumn('content', 'text');
              $table->addColumn('excerpt', 'text' , ['notnull' => false]);
              $table->addColumn('comment_status', 'boolean', ['default' => false]);
              $table->addColumn('comment_count', 'integer', ['default' => 0]);
              $table->addColumn('data', 'json_array', ['notnull' => false]);
              $table->addColumn('roles', 'simple_array', ['notnull' => false]);
              $table->addColumn('category_id', 'integer', ['notnull' => false]);
              $table->addColumn('tags', 'simple_array' , ['notnull' => false]);
              $table->setPrimaryKey(['id']);
              $table->addUniqueIndex(['slug'], '@DPNBLOG_POST_SLUG');
              $table->addIndex(['title'], '@DPNBLOG_POST_TITLE');
              $table->addIndex(['user_id'], '@DPNBLOG_POST_USER_ID');
              $table->addIndex(['date'], '@DPNBLOG_POST_DATE');
          });
      }

      if($util->tableExists('@dpnblog_category') === false){
          $util->createTable('@dpnblog_category' , function($table) {
              $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
              $table->addColumn('title', 'string', ['length' => 255]);
              $table->addColumn('slug', 'string', ['length' => 255]);
              $table->addColumn('status', 'string', ['length' => 255]);
              $table->addColumn('date', 'datetime', ['notnull' => false]);
              $table->addColumn('data', 'json_array', ['notnull' => false]);
              $table->addColumn('sub_category', 'simple_array', ['notnull' => false]);
              $table->setPrimaryKey(['id']);
          });
      }

      if ($util->tableExists('@dpnblog_comment') === false) {
          $util->createTable('@dpnblog_comment', function ($table) {
              $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
              $table->addColumn('parent_id', 'integer', ['unsigned' => true, 'length' => 10]);
              $table->addColumn('post_id', 'integer', ['unsigned' => true, 'length' => 10]);
              $table->addColumn('user_id', 'string', ['length' => 255]);
              $table->addColumn('author', 'string', ['length' => 255]);
              $table->addColumn('email', 'string', ['length' => 255]);
              $table->addColumn('url', 'string', ['length' => 255, 'notnull' => false]);
              $table->addColumn('ip', 'string', ['length' => 255]);
              $table->addColumn('created', 'datetime');
              $table->addColumn('content', 'text');
              $table->addColumn('status', 'smallint');
              $table->setPrimaryKey(['id']);
              $table->addIndex(['author'], '@DPNBLOG_COMMENT_AUTHOR');
              $table->addIndex(['created'], '@DPNBLOG_COMMENT_CREATED');
              $table->addIndex(['status'], '@DPNBLOG_COMMENT_STATUS');
              $table->addIndex(['post_id'], '@DPNBLOG_COMMENT_POST_ID');
              $table->addIndex(['post_id', 'status'], '@DPNBLOG_COMMENT_POST_ID_STATUS');
          });
      }


    },

    'uninstall' => function ($app) {
      $util = $app['db']->getUtility();

      if ($util->tableExists('@dpnblog_post')) {
          $util->dropTable('@dpnblog_post');
      }

      if ($util->tableExists('@dpnblog_comment')) {
          $util->dropTable('@dpnblog_comment');
      }

      if ($util->tableExists('@dpnblog_category')) {
          $util->dropTable('@dpnblog_category');
      }
      if ($util->tableExists('@dpnblog_like')) {
          $util->dropTable('@dpnblog_like');
      }
    },
    'enable' => function ($app) {},
    'disable' => function ($app) {},
    'updates' => [

      '0.11.2' => function ($app) {

          $db = $app['db'];
          $util = $db->getUtility();

          foreach (['@dpnblog_post', '@dpnblog_comment'] as $name) {
              $table = $util->getTable($name);

              foreach ($table->getIndexes() as $name => $index) {
                  if ($name !== 'primary') {
                      $table->renameIndex($index->getName(), $app['db']->getPrefix() . $index->getName());
                  }
              }

              if ($app['db']->getDatabasePlatform()->getName() === 'sqlite') {
                  foreach ($table->getColumns() as $column) {
                      if (in_array($column->getType()->getName(), ['string', 'text'])) {
                          $column->setOptions(['customSchemaOptions' => ['collation' => 'NOCASE']]);
                      }
                  }
              }
          }

          $util->migrate();
      },

      '1.4.2' => function($app){
        $util = $app['db']->getUtility();
        if ($util->tableExists('@dpnblog_like') == false) {
          $util->createTable('@dpnblog_like' , function($table){
            $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
            $table->addColumn('user_id' , 'integer' , ['notnull' => false]);
            $table->addColumn('like_id' , 'integer' , ['notnull' => false]);
            $table->addColumn('like_sy' , 'string' , ['default' => 'post']);
            $table->addColumn('date', 'datetime', ['notnull' => false]);
            $table->addColumn('data', 'json_array', ['notnull' => false]);
            $table->setPrimaryKey(['id']);
          });
        }
      }

    ]
];
?>
