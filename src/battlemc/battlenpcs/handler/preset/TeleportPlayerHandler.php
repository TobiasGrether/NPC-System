<?php
namespace battlemc\battlenpcs\handler\preset;
use battlemc\battlenpcs\handler\NPCEventHandler;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\math\Vector3;
use pocketmine\Player;

class TeleportPlayerHandler extends NPCEventHandler
{

	/**
	 * @var Vector3
	 */
	public $location;
	public function onHit(Entity &$entity, EntityDamageByEntityEvent &$event): bool
	{
		$player = $event->getDamager();
		if($player instanceof Player){
			$player->teleport($this->location);
		}
		return false;
	}
}