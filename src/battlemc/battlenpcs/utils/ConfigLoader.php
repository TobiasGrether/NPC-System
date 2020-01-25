<?php

namespace battlemc\battlenpcs\utils;

use battlemc\battlenpcs\caches\TagCache;
use battlemc\battlenpcs\caches\TypeCache;
use battlemc\battlenpcs\classes\AssignableTag;
use battlemc\battlenpcs\classes\CustomType;
use pocketmine\utils\Config;
use pocketmine\utils\MainLogger;

class ConfigLoader
{
	public function load(string $path)
	{
		$config = new Config($path . "config.yml", Config::YAML);
		$customs = $config->get("enabled-customs");
		foreach ($customs as $custom) {
			if (file_exists($path . $custom . "_geometry.json")) {
				$geometry = file_get_contents($path . $custom . "_geometry.json");
				if (file_exists($path . $custom . "_skin.png")) {
					$skinData = $this->getFromPathBytes($path . $custom . "_skin.png");
					$type = new CustomType();
					$type->setGeometry($geometry);
					$type->setImageData($skinData);
					$type->setName($custom);
					TypeCache::add($type);
					var_dump("Added " . $type->getName());
				} else {
					MainLogger::getLogger()->warning("Could not find Skin File For Custom Entity \"" . $custom . "\"");
					continue;
				}
			} else {
				MainLogger::getLogger()->warning("Could not find Geometry File For Custom Entity \"" . $custom . "\"");
				continue;
			}


		}
		foreach($config->get("tags") as $tagData){
			if($tagData["enabled"] === true){
				$tag = new AssignableTag();
				$tag->setName($tagData["name"]);
				$tag->setDisplayLayout($tagData["display-layout"]);
				TagCache::add($tag);
				var_dump("Added Tag " . $tag->getName());
			}
		}
	}

	public function getFromPathBytes(string $path): string
	{
		$img = imagecreatefrompng($path);
		$bytes = '';
		$l = (int)getimagesize($path)[1];
		for ($y = 0; $y < $l; $y++) {
			for ($x = 0; $x < 64; $x++) {
				$rgba = imagecolorat($img, $x, $y);
				$a = ((~((int)($rgba >> 24))) << 1) & 0xff;
				$r = ($rgba >> 16) & 0xff;
				$g = ($rgba >> 8) & 0xff;
				$b = $rgba & 0xff;
				$bytes .= chr($r) . chr($g) . chr($b) . chr($a);
			}
		}
		return $bytes;
	}
}