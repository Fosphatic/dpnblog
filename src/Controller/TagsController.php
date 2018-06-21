<?php
namespace Dpn\Blog\Controller;

use Pagekit\Application as App;
use Dpn\Blog\Model\Tags;
/**
* @Access(admin=true)
*/
class TagsController{

  /**
   * @Access("system: access settings")
   * @Route("/tag")
   */
  public function tagAction()
  {

      $query = Tags::findAll();

      return [
        '$view' =>[
          'title' => __('Tags Page'),
          'name'  => 'dpnblog:views/admin/tags-index.php'
        ],
        '$data' => [
          'tags'  => $query
        ]
      ];
  }

}
 ?>
