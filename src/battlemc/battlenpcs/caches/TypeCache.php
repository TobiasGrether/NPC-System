<?php

namespace battlemc\battlenpcs\caches;

use battlemc\battlenpcs\classes\CustomType;

class TypeCache
{
	/**
	 * @var CustomType[]
	 */
	private static $types = [];

	public static function add(CustomType $type): void
	{
		if (!self::exists($type->getName())) {
			self::$types[$type->getName()] = $type;
		}
	}

	public static function exists(string $typeName): bool
	{
		return array_key_exists($typeName, self::$types);
	}

	public static function get(string $typeName): ?CustomType
	{
		if (self::exists($typeName))
			return self::$types[$typeName];
		else
			return null;
	}

	public static function getAll(): array
	{
		return self::$types;
	}
}