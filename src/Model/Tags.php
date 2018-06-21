<?php
namespace Dpn\Blog\Model;

use Pagekit\Database\ORM\ModelTrait;

/**
* @Entity(tableClass="@blog_tag")
*/
class Tags{

  use ModelTrait;

  /** @Column(type="integer") @Id **/
  public $id;

  /** @Column(type="string") **/
  public $title;

  /** @Column(type="string") **/
  public $slug;

  /** @Column(type="json_array") **/
  public $data;

}
?>
