<?php

namespace Pastheme\Blog\Conf;

use Pagekit\Application as App;

class GeneralConf{

  public function likeActive(){

    $module = App::module('dpnblog');

    if ($module->config['like'] === true) {
      return true;
    }

  }

  public function shareActive(){

    $module = App::module('dpnblog');

    if ($module->config['share']['active'] === true) {
      return true;
    }

  }

}

?>
