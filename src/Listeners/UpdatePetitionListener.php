<?php 
namespace Vicoders\Notification\Listeners;

use NF\Facades\Log;
use Vicoders\Notification\Events\UpdatePetitionEvent;
use Vicoders\Notification\Facades\NotificationManager;
use Vicoders\Notification\Models\Notify;

class UpdatePetitionListener 
{
	public function __construct()
	{
		
	}

	public function handle(UpdatePetitionEvent $event) {
		$id_petition = $event->id_petition;
		Log::info($id_petition);
		NotificationManager::saveDataToDatabase($id_petition, Notify::NOTIFIABLE_TYPE);
        NotificationManager::sendEmail('daudq.info@gmail.com', 'Update kiến nghị', ['id_petition' => $id_petition]);
	}
}