<?php

namespace Vicoders\Notification\Models;

use NF\Models\Model;

/**
 *
 */
class Notify extends Model
{
    const TYPE            = 1;
    const NOTIFIABLE_TYPE = 'petition';
    const NOTIFIABLE_TYPE_VICTORY = 'petition_victory';
    const NOTIFIABLE_TYPE_COLLECT = 'petition_collect';
    const NOTIFIABLE_TYPE_PUBLIC = 'petition_public';
    const UNREAD          = 0;
    const READ            = 1;
    /**
     * [$table_name name of table]
     * @var string
     */
    protected $table = PREFIX_TABLE . 'notifications';

    /**
     * [$primary_id primary key of table]
     * @var string
     */
    protected $primary_key = 'id';

    protected $fillable = ['type', 'notifiable_id', 'notifiable_type', 'content', 'created_at', 'updated_at'];
}
