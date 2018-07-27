<?php

namespace Pastheme\Blog\Controller;

use Pagekit\Application as App;
use Pastheme\Blog\Model\Post;
use Pagekit\User\Model\Role;
use Pastheme\Blog\Model\Category;

/**
* @Access("dpnblog: manage own posts || dpnblog: manage all posts")
* @Route("category", name="category")
*/
class CategoryApiController
{
  /**
  * @Access(admin=true)
  * @Route(methods="POST")
  * @Request({"data": "array"}, csrf=true)
  */
  public function saveAction($data)
  {

    if (!$data['id']) {
      unset($data['category']['id']);
      $query = Category::create();
    }else{
      $query = Category::find($data['id']);
    }

    if (empty($data['category']['date'])) {
      $data['category']['date'] = new \DateTime;
    }else{
      unset($data['category']['date']);
    }

    if (empty($data['category']['slug'])) {
      $data['category']['slug'] = App::filter(!empty($data['category']['slug']) ? $data['category']['slug']:$data['category']['title'] , 'slugify');
    }

    $query->save($data['category']);

    return [
      'message' => true,
      'data'    => $query
    ];
  }

  /**
  * @Access(admin=true)
  * @Route(methods="POST")
  * @Request({"category": "array"}, csrf=true)
  */
  public function deleteAction($category)
  {
    $query = Category::find($category['id']);
    $query->delete();

    return [
      'message' => true
    ];
  }

  /**
  * @Access(admin=true)
  * @Route(methods="POST")
  * @Request({"id":"array" , "value":"string"} , csrf=true)
  */
  public function changeAction($id , $value){
    $query = Category::find($id['id']);
    $query->status = $value;
    $query->save();
    return ['message' => true];
  }

  /**
  * @Access(admin=true)
  * @Route(methods="POST")
  * @Request({"id":"array"} , csrf=true)
  */
  public function removeAction($id){
    foreach ($id as $value) {
      $query = Category::find($value);
      $query->delete();
    }
    return ['message' => true];
  }

  /**
  * @Access(admin=true)
  * @Route(methods="POST")
  * @Request({"id": "integer"}, csrf=true)
  */
  public function countAction($id){
    return ['status'  => 'yes'];
  }
}
