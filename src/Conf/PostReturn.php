<?php

namespace Pastheme\Blog\Conf;

class PostReturn{

  public function abort($data , $resMsg = ['status' => 200 , 'err' => null] , $auth = null ){

    if ($resMsg['status'] !== 200) {
      $returnMsg = [
        'status' => $resMsg['status'],
        'err'    => !empty($resMsg['err']) ? $resMsg['err']:'undefined'
      ];

      $returnData = 'undefined';
    }

    if ($resMsg['status'] === 200) {
      $returnData = $data;
    }

    return [
      'status' => !empty($returnMsg) ? $returnMsg:$resMsg,
      'data'   => $returnData,
      'auth'   => $auth
    ];

  }

}

?>
