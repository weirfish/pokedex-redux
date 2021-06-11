<?php

namespace PtuDex\Home;

class IconProvider
{
	public static function getMoveCategoryIcon(string $moveCategory) : string
	{
		switch($moveCategory)
		{
			case \PtuDex\Common\Enums\MoveCategories::PHYSICAL:
				return self::getBaseIconPath() . "category/physical.png";
			case \PtuDex\Common\Enums\MoveCategories::SPECIAL:
				return self::getBaseIconPath() . "category/special.png";
			case \PtuDex\Common\Enums\MoveCategories::STATUS:
				return self::getBaseIconPath() . "category/status.png";
			case \PtuDex\Common\Enums\MoveCategories::MC_STATIC:
				return self::getBaseIconPath() . "category/static.png";
		}
	}

	public static function getPokedexIconPath() : string
	{
		return self::getBaseIconPath() . "menu/pokedex.png";
	}

	public static function getMetronomeIconPath() : string
	{
		return self::getBaseIconPath() . "menu/metronome.png";
	}

	public static function getTypeCoverageIconPath() : string
	{
		return self::getBaseIconPath() . "menu/type-coverage.png";
	}

	public static function getDamageCalculatorIconPath() : string
	{
		return self::getBaseIconPath() . "menu/damage-calculator.png";
	}

	public static function getWarningIconPath() : string
	{
		return self::getBaseIconPath() . "warning.png";
	}

	private static function getBaseIconPath() : string
	{
		return \Engine\Util\Paths::getImagePath() . "icon/";
	}
}