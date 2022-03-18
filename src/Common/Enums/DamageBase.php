<?php

namespace PtuDex\Common\Enums;

enum DamageBase : string
{
	case DB0  = "0";
	case DB1  = "1d6+1";
	case DB2  = "1d6+3";
	case DB3  = "1d6+5";
	case DB4  = "1d8+6";
	case DB5  = "1d8+8";
	case DB6  = "2d6+8";
	case DB7  = "2d6+10";
	case DB8  = "2d8+10";
	case DB9  = "2d10+10";
	case DB10 = "3d8+10";
	case DB11 = "3d10+10";
	case DB12 = "3d12+10";
	case DB13 = "4d10+10";
	case DB14 = "4d10+15";
	case DB15 = "4d10+20";
	case DB16 = "5d10+20";
	case DB17 = "5d12+25";
	case DB18 = "6d12+25";
	case DB19 = "6d12+30";
	case DB20 = "6d12+35";
	case DB21 = "6d12+40";
	case DB22 = "6d12+45";
	case DB23 = "6d12+50";
	case DB24 = "6d12+55";
	case DB25 = "6d12+60";
	case DB26 = "7d12+65";
	case DB27 = "8d12+70";
	case DB28 = "8d12+80";

	public static function getDamageBase(int $dbNumber) : string
	{
		if($dbNumber < 0 || $dbNumber > 29)
			throw new \LogicException("DB{$dbNumber} is not supported");

		$const = "DB" . $dbNumber;

		return constant(self::class . "::$const");
	}

	public static function getDbNumber(string $damageBase) : string
	{
		if($damageBase instanceof self)
			throw new \LogicException("{$damageBase} is not supported");

		$constants = self::cases();

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
		if($damageBase === self::DB0)
			return self::DB0;

		$dbNumber = \intval(self::getDbNumber($damageBase)) + 2;

		$constName = "DB" . $dbNumber;

		return constant("self::" . $constName);
	}
}