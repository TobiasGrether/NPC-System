<?php

namespace battlemc\battlenpcs\handler;

use battlemc\battlenpcs\entities\CustomNPC;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\timings\Timings;
use pocketmine\timings\TimingsHandler;

class EventListener implements Listener
{

	public function onHit(EntityDamageByEntityEvent $event)
	{
		$entity = $event->getEntity();
		if ($entity instanceof CustomNPC) {
			if ($entity->hasHandler()) {
				if (!$entity->getHandler()->onHit($entity, $event)) {
					$event->setCancelled(true);
				}
			}
		}
	}
}