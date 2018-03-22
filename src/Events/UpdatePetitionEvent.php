<?php
namespace Vicoders\Notification\Events;

use Symfony\Component\EventDispatcher\Event;
use Vicoders\Notification\Models\Notify;
use Vicoders\Notification\Models\UserNotify;

/**
 * Notify event
 */
class UpdatePetitionEvent extends Event
{
    const NAME = 'update.petition';

    public $id_petition;

    public function __construct($id_petition)
    {
        $this->id_petition = $id_petition;
    }
}
