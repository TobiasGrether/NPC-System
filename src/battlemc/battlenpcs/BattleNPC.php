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

	public function onChat(PlayerChatEvent $event){
		$player = $event->getPlayer();
		$npc = new NPCBuilder();
		$entity = $npc->setName($event->getMessage())
			->setLevel($player->getLevel())
			->setPosition($player->getLocation())
			->setType(TypeCache::get("bloody"))
			->setHandler(new TestEventHandler())
			->addTag(TagCache::get("new"))
			->build();
		$entity->spawnToAll();
	}
}