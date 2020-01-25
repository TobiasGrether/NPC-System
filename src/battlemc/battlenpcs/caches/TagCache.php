<?php

namespace battlemc\battlenpcs\caches;

use battlemc\battlenpcs\classes\AssignableTag;

class TagCache
{
	/**
	 * @var AssignableTag[]
	 */
	private static $tags = [];

	public static function add(AssignableTag $tag): void
	{
		if (!self::exists($tag->getName())) {
			self::$tags[$tag->getName()] = &$tag;
		}
	}

	public static function exists(string $tagName): bool
	{
		return array_key_exists($tagName, self::$tags);
	}

	public static function get(string $tagName): ?AssignableTag
	{
		if (self::exists($tagName))
			return self::$tags[$tagName];
		else
			return null;
	}

	public static function getAll(): array
	{
		return self::$tags;
	}
}