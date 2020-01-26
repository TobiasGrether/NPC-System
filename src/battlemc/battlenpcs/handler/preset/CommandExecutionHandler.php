<?php

namespace battlemc\battlenpcs\handler\preset;

use battlemc\battlenpcs\handler\NPCEventHandler;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\Player;
use pocketmine\Server;

class CommandExecutionHandler extends NPCEventHandler
{
	private $command;


	public function onHit(Entity &$entity, EntityDamageByEntityEvent &$event): bool
	{
		$player = $event->getDamager();
		if ($player instanceof Player) {
			Server::getInstance()->dispatchCommand($player, $this->getCommand());
		}
		return false;
	}

	/**
	 * @return mixed
	 */
	public function getCommand()
	{
		return $this->command;
	}

	/**
	 * @param mixed $command
	 */
	public function setCommand($command): void
	{
		$this->command = $command;
	}
}