<?php
namespace Dpn\Blog\Controller;

use Pagekit\Application as App;
use Dpn\Blog\Model\Tags;

/**
* @Access(admin=true)
*/
class TagsApiController{

  /**
  * @Route(methods="POST")
  * @Request({"data":"array"} , csrf=true)
  */
  public function addAction($data){

    if (!isset($data['id'])) {
      $data['id'] = 0;
    }

    if (!$query = Tags::find($data['id'])) {
      $query = Tags::create();
    }

    if (empty($data['slug'])) {
      $data['slug'] = App::filter(!empty($data['slug']) ? $data['slug']:$data['title'] , 'slugify');
    }

    $query->save($data);

    return ['status' => 200 , 'data' => $query];
  }

  /**
  * @Route(methods="POST")
  * @Request({"id":"array"} , csrf=true)
  */
  public function removeTagsAction($id){
    foreach ($id as $value) {
      $query = Tags::find($value);
      $query->delete();
    }
    return ['message' => true];
  }

}
?>
