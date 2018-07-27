<?php

namespace Pastheme\Blog\Model;

use Pagekit\Application as App;
use Pagekit\System\Model\DataModelTrait;
use Pagekit\User\Model\AccessModelTrait;
use Pagekit\User\Model\User;

/**
 * @Entity(tableClass="@dpnblog_post")
 */
class Post implements \JsonSerializable
{
    use AccessModelTrait, DataModelTrait, PostModelTrait;

    /* Post draft status. */
    const STATUS_DRAFT = 0;

    /* Post pending review status. */
    const STATUS_PENDING_REVIEW = 1;

    /* Post published. */
    const STATUS_PUBLISHED = 2;

    /* Post unpublished. */
    const STATUS_UNPUBLISHED = 3;

    /** @Column(type="integer") @Id */
    public $id;

    /** @Column(type="string") */
    public $title;

    /** @Column(type="string") */
    public $slug;

    /** @Column(type="integer") */
    public $user_id;

    /** @Column(type="datetime") */
    public $date;

    /** @Column(type="text") */
    public $content = '';

    /** @Column(type="text") */
    public $excerpt = '';

    /** @Column(type="smallint") */
    public $status;

    /** @Column(type="datetime") */
    public $modified;

    /** @Column(type="boolean") */
    public $comment_status;

    /** @Column(type="integer") */
    public $comment_count = 0;

    /** @Column(type="integer") */
    public $category_id;

    /** @Column(type="simple_array") */
    public $tags;

    /**
     * @BelongsTo(targetEntity="User", keyFrom="user_id")
     */
    public $user;

    /**
    * @BelongsTo(targetEntity="Category" , keyFrom="category_id" , keyTo="id")
    */
    public $category;

    /**
     * @HasMany(targetEntity="Comment", keyFrom="id", keyTo="post_id")
     * @OrderBy({"created" = "DESC"})
     */
    public $comments;

    /** @var array */
    protected static $properties = [
        'author' => 'getAuthor',
        'published' => 'isPublished',
        'accessible' => 'isAccessible'
    ];

    public static function getStatuses()
    {
        return [
            self::STATUS_PUBLISHED => __('Published'),
            self::STATUS_UNPUBLISHED => __('Unpublished'),
            self::STATUS_DRAFT => __('Draft'),
            self::STATUS_PENDING_REVIEW => __('Pending Review')
        ];
    }

    public function getStatusText()
    {
        $statuses = self::getStatuses();

        return isset($statuses[$this->status]) ? $statuses[$this->status] : __('Unknown');
    }

    public function isCommentable()
    {
        $blog      = App::module('dpnblog');
        $autoclose = $blog->config('comments.autoclose') ? $blog->config('comments.autoclose_days') : 0;

        return $this->comment_status && (!$autoclose or $this->date >= new \DateTime("-{$autoclose} day"));
    }

    public function getGravatar()
    {

      if (isset($this->user)) {

        $email = $this->user->email;
        $s = 200;
        $d = 'mp';
        $r = 'g';
        $img = false;
        $atts = array();

        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;

      }

      return false;

    }

    public function getAuthor()
    {
        return $this->user ? $this->user->username : null;
    }

    public function isPublished()
    {
        return $this->status === self::STATUS_PUBLISHED && $this->date < new \DateTime;
    }

    public function isAccessible(User $user = null)
    {
        return $this->isPublished() && $this->hasAccess($user ?: App::user());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = [
            'url' => App::url('@dpnblog/id', ['id' => $this->id ?: 0], 'base')
        ];

        if ($this->comments) {
            $data['comments_pending'] = count(array_filter($this->comments, function ($comment) {
                return $comment->status == Comment::STATUS_PENDING;
            }));
        }

        return $this->toArray($data);
    }
}
