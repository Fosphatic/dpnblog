<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 26.04.2018
 * Time: 13:21
 */

namespace Pastheme\Blog\Model;

use Pagekit\Application as App;
use Pagekit\Database\ORM\ModelTrait;


/**
 * Class Category
 * @package Pastheme\Blog\Model
 * @Entity(tableClass="@dpnblog_category")
 */
class Category
{
    use ModelTrait;

    /** @Column(type="integer") @Id */
    public $id;

    /** @Column(type="string") */
    public $title;

    /** @Column(type="string") */
    public $slug;

    /** @Column(type="datetime") */
    public $date;

    /** @Column(type="json_array") */
    public $data;

    /** @Column(type="simple_array") */
    public $sub_category;

    /** @Column(type="integer") */
    public $status;

    /**
     * @HasMany(targetEntity="Post", keyFrom="id", keyTo="category_id")
     */
    public $post;

}
