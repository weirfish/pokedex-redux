<?php

namespace PtuDex\Home;

class IconProvider
{
	public static function getPokedexIconPath() : string
	{
		return self::getBaseIconPath() . "pokedex.png";
	}

	public static function getMetronomeIconPath() : string
	{
		return self::getBaseIconPath() . "metronome.png";
	}

	public static function getTypeCoverageIconPath() : string
	{
		return self::getBaseIconPath() . "type-coverage.png";
	}

	public static function getDamageCalculatorIconPath() : string
	{
		return self::getBaseIconPath() . "damage-calculator.png";
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