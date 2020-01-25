<?php

namespace battlemc\battlenpcs\classes;

use battlemc\battlenpcs\entities\CustomNPC;
use battlemc\battlenpcs\handler\NPCEventHandler;
use pocketmine\entity\Skin;
use pocketmine\level\Level;
use pocketmine\math\Vector3;

use InvalidArgumentException;

class NPCBuilder
{

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var AssignableTag[]
	 */
	private $tags = [];

	/**
	 * @var CustomType
	 */
	private $type;

	/**
	 * @var Vector3
	 */
	private $position;

	/** @var Level */
	private $level;


	/**
	 * @var NPCEventHandler
	 */
	private $handler = null;

	public function setType(CustomType $type): self
	{
		$this->type = $type;
		return $this;
	}

	public function addTag(AssignableTag $tag): self
	{
		$this->tags[] = $tag;
		return $this;
	}

	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function setLevel(Level $level): self
	{
		$this->level = $level;
		return $this;
	}

	public function setPosition(Vector3 $position): self
	{
		$this->position = $position;
		return $this;
	}

	public function setHandler(NPCEventHandler $handler): self
	{
		$this->handler = $handler;
		return $this;
	}

	public function build(): CustomNPC
	{
		if ($this->level instanceof Level) {
			if ($this->position instanceof Vector3) {
				if ($this->name !== null && $this->name !== "") {
					$npc = new CustomNPC(new Skin(uniqid(), $this->getType()->getImageData()), $this->level, CustomNPC::createBaseNBT($this->position));
					foreach ($this->tags as &$tag) {
						$npc->addTag($tag);
					}
					$npc->setHeader($this->name);
					$npc->setHandler($this->handler ?? null);
					// TODO add Geometry
					$npc->update();
					return $npc;
				}
			}
		}
		throw new InvalidArgumentException("It seems at least one of three (Level, Position, Header ) required arguments for your NPC Build is missing");
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return CustomType
	 */
	public function getType(): CustomType
	{
		return $this->type;
	}

	/**
	 * @return Vector3
	 */
	public function getPosition(): Vector3
	{
		return $this->position;
	}

	/**
	 * @return Level
	 */
	public function getLevel(): Level
	{
		return $this->level;
	}

	/**
	 * @return AssignableTag[]
	 */
	public function getTags(): array
	{
		return $this->tags;
	}

	/**
	 * @param AssignableTag[] $tags
	 * @return NPCBuilder
	 */
	public function setTags(array $tags): self
	{
		$this->tags = $tags;
		return $this;
	}
}