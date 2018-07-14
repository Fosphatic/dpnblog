<?php

namespace Pastheme\Blog\Controller;

use Pagekit\Application as App;
use Pastheme\Blog\Model\Like;

class ApiComponentController{

  /**
  * @Route(methods="POST")
  * @Request({"id":"int" , "like":"string"} , csrf=true)
  */
  public function getLikeAction($id = null , $like = "post"){

    if (!empty($id)) {

      $query = Like::where(['like_id = ?' , 'like_sy = ?'] , [$id , $like])->related('user')->get();

      return['status' => 200 , 'liked' => (array) $query];
    }

    return['status' => 400 , 'msg' => 'No Found Post Id'];

  }

  /**
  * @Route(methods="POST")
  * @Request({"like":"string" , "post":"integer"} , csrf=true)
  */
  public function onLikeAction($like = 'post' , $post = null){

    try {

      if (empty($post)) {
        App::abort(404 , 'Not Fount Post ID');
      }

      if (App::user()->isAuthenticated() === false) {
        App::abort(404 , 'UnAuthenticated');
      }

      $user = App::user();

      if (!$query = Like::where(['like_sy = ?' , 'like_id = ?' , 'user_id = ?'] , [$like , $post , $user->id] )->first() ) {

        $query = Like::create([
            'user_id' => $user->id,
            'like_id' => $post,
            'like_sy'    => $like,
            'date'    => new \DateTime(),
        ]);

        $query->save();

      }else{

        $query->delete();

      }

      return [
        'status' => 200,
      ];


    } catch (\Exception $e) {

      return [
        'status' => 400,
        'msg'    => 'Error'
      ];

    }


  }


}

?>
