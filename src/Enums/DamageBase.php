<?php

namespace PtuDex\Enums;

class DamageBase extends \Engine\Abstracts\Enum
{
	const DB0  = "0";
	const DB1  = "1d6+1";
	const DB2  = "1d6+3";
	const DB3  = "1d6+5";
	const DB4  = "1d8+6";
	const DB5  = "1d8+8";
	const DB6  = "2d6+8";
	const DB7  = "2d6+10";
	const DB8  = "2d8+10";
	const DB9  = "2d10+10";
	const DB10 = "3d8+10";
	const DB11 = "3d10+10";
	const DB12 = "3d12+10";
	const DB13 = "4d10+10";
	const DB14 = "4d10+15";
	const DB15 = "4d10+20";
	const DB16 = "5d10+20";
	const DB17 = "5d12+25";
	const DB18 = "6d12+25";
	const DB19 = "6d12+30";
	const DB20 = "6d12+35";
	const DB21 = "6d12+40";
	const DB22 = "6d12+45";
	const DB23 = "6d12+50";
	const DB24 = "6d12+55";
	const DB25 = "6d12+60";
	const DB26 = "7d12+65";
	const DB27 = "8d12+70";
	const DB28 = "8d12+80";

	public static function getDamageBase(int $dbNumber) : string
	{
		if($dbNumber < 0 || $dbNumber > 29)
			throw new \LogicException("DB{$dbNumber} is not supported");

		$const = "DB" . $dbNumber;

		return constant(self::class . "::$const");
	}

	public static function getDbNumber(string $damageBase) : string
	{
		if(!self::isConstantValue($damageBase))
			throw new \LogicException("{$damageBase} is not supported");

		$constants = self::getConstants();

		/** @var \ReflectionClassConstant $constant */
		foreach($constants as $key => $constant)
		{
			if($constant === $damageBase)
				return substr($key, 2);
		}

		throw new \LogicException("{$damageBase} is not supported");
	}

	public static function stabifyDB(string $damageBase) : string
	{
		$dbNumber = \intval(self::getDbNumber($damageBase)) + 2;

		$constName = "DB" . $dbNumber;

		return constant("self::" . $constName);
	}
}