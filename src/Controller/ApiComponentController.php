<?php

namespace Pastheme\Blog\Controller;

use Pagekit\Application as App;
use Pastheme\Blog\Model\Like;
use Pastheme\Blog\Conf\PostReturn;

class ApiComponentController extends PostReturn{

  /**
  * @Route(methods="POST")
  * @Request({"id":"integer" , "like":"string"} , csrf=true)
  */
  public function getLikeAction($id = null , $like = "post"){

    if (!App::user()->isAuthenticated()) {
      $userAuth = false;
    }else{
      $user = App::user();
      $userAuth = $user->id;

      if (Like::where(['like_id = ?' , 'like_sy = ?' , 'user_id = ?'] , [$id , $like , $userAuth])->first()) {
        $controller['hasLike'] = true;
      }else{
        $controller['hasLike'] = false;
      }

    }

    if (empty($id)) {
      return self::abort(false , ['status' => 400 , 'err' =>'(Err:002) Function could not find post id'] , $userAuth);
    }

    $query = Like::where(['like_id = ?' , 'like_sy = ?'] , [$id , $like])->related('user')->get();

    $controller['query'] = $query;

    return self::abort($controller , ['status' => 200 , 'err' =>'Success'] , $userAuth);

  }

  /**
  * @Route(methods="POST")
  * @Request({"id":"integer" , "like":"string"} , csrf=true)
  */
  public function likeAction($id = null , $like = "post"){

    if (!App::user()->isAuthenticated()) {
      return self::abort(false , ['status' => 400 , 'err' =>'(Err:003) You must log in first']);
    }

    $user = App::user();

    if (!$query = Like::where(['like_sy = ?' , 'like_id = ?' , 'user_id = ?'] , [$like , $id , $user->id] )->first() ) {

      $query = Like::create([
          'user_id' => $user->id,
          'like_id' => $id,
          'like_sy' => $like,
          'date'    => new \DateTime(),
      ]);
      $query->save();

      return self::abort(false , ['status' => 200 , 'err' =>'Success']);

    }else{
      $query->delete();

      return self::abort(false , ['status' => 200 , 'err' =>'Success']);
    }

  }

}

?>
