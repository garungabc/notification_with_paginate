<?php

namespace Vicoders\Notification\Models;

use NF\Models\Model;

/**
 *
 */
class UserNotify extends Model
{
    const UNREAD          = 0;
    const READ            = 1;
    /**
     * [$table_name name of table]
     * @var string
     */
    protected $table = PREFIX_TABLE . 'user_notify';

    /**
     * [$primary_id primary key of table]
     * @var string
     */
    protected $primary_key = 'id';

    protected $fillable = ['user_id', 'notification_id', 'status','created_at', 'updated_at'];
}
