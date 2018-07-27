<?php

namespace Pastheme\Blog\Controller;

use Pagekit\Application as App;

/**
* @Access(admin=true)
*/
class BlogController{

  /**
  * @Route("/post")
  */
  public function postAction(){

    return 'Yes';

  }

  /**
  * @Access("dpnblog: manage all categorys")
  * @Request({"page":"int" , "filter":"array"})
  */
  public function categoryAction($page = null , $filter = null){

    return [
      '$view' => [
        'title' => __('Category'),
        'name'  => 'dpnblog:views/admin/categorys.php'
      ],
      '$data' => [
        'canEditAll' => App::user()->hasAccess('dpnblog: manage all categorys'),
        'config' => [
          'filter' => (object) $filter,
          'page'   => $page
        ]
      ]
    ];

  }

}

?>
