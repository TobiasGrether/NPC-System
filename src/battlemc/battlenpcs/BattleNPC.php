<?php
namespace battlemc\battlenpcs;
use battlemc\battlenpcs\caches\TagCache;
use battlemc\battlenpcs\caches\TypeCache;
use battlemc\battlenpcs\classes\NPCBuilder;
use battlemc\battlenpcs\handler\EventListener;
use battlemc\battlenpcs\tests\TestEventHandler;
use battlemc\battlenpcs\utils\ConfigLoader;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;

class BattleNPC extends PluginBase implements Listener{

	public function onEnable()
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		if(!file_exists($this->getDataFolder() . "config.yml")){
			$this->saveResource("config.yml");
		}
		$loader = new ConfigLoader();
		$loader->load($this->getDataFolder());
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}
}