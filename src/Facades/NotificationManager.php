<?php

namespace Vicoders\Notification\Facades;

use Illuminate\Support\Facades\Facade;

class NotificationManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'NotificationManager';
    }
}
