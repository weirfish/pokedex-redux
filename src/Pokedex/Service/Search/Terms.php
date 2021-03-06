<?php

namespace PtuDex\Pokedex\Service\Search;

enum Terms
{
	const NAME       = "name";
	const TYPE       = "type";
	const ATTRIBUTE  = "attribute";
	const SKILL      = "skill";
	const MOVE       = "move";
	const LEARN_MOVE = "learn";
	const TUTOR_MOVE = "tutor";
	const HMTM_MOVE  = "hmtm";
	const EGG_MOVES  = "egg";
	const ABILITY    = "ability";
	const CAPABILITY = "capability";

	public static function isNumericComparison($value)
	{
		if(!self::isConstantValue($value))
			throw new \LogicException("{$value} is not a valid value");

		switch($value)
		{
			case self::ATTRIBUTE:
			case self::SKILL:
				return true;
		}

		return false;
	}

	public static function isContainsComparison($value)
	{
		if(!self::isConstantValue($value))
			throw new \LogicException("{$value} is not a valid value");

		switch($value)
		{
			case self::TYPE:
			case self::MOVE:
			case self::LEARN_MOVE:
			case self::TUTOR_MOVE:
			case self::HMTM_MOVE:
			case self::EGG_MOVES:
			case self::ABILITY:
			case self::CAPABILITY:
				return true;
		}

		return false;
	}

	public static function isSubstringComparison($value)
	{
		if(!self::isConstantValue($value))
			throw new \LogicException("{$value} is not a valid value");

		switch($value)
		{
			case self::NAME:
				return true;
		}

		return false;
	}

	public static function getClosestTerm(string $target, int $count)
	{
		return \Engine\Util\Strings::getClosestStringsToTarget($target, $count, ...self::getConstants())[0];
	}
}