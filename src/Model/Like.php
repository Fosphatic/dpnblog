<?php

namespace Pastheme\Blog\Model;
use Pagekit\Application as App;
use Pagekit\Database\ORM\ModelTrait;

/**
* @Entity(tableClass="@dpnblog_like")
*/
class Like{
  use ModelTrait;

  /** @Column(type="integer") @Id */
  public $id;

  /** @Column(type="integer") */
  public $user_id;

  /** @Column(type="integer") */
  public $like_id;

  /** @Column(type="string") */
  public $like_sy;

  /** @Column(type="json_array") */
  public $data;

  /** @Column(type="datetime") */
  public $date;

  /**
  * @BelongsTo(targetEntity="User", keyFrom="user_id")
  */
  public $user;

}

?>
