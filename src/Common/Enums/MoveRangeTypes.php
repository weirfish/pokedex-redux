<?php

namespace PtuDex\Common\Enums;

enum MoveRangeTypes : string
{
	const PREFIX              = "moveRangeTypes";

	const MELEE               = "melee";
	const RANGED              = "ranged";
	const RANGED_BLAST        = "rangedBlast";
	const BURST               = "burst";
	const CARDINALLY_ADJACENT = "cardinallyAdjacent";
	const ADJACENT            = "adjacent";
	const CLOSE_BLAST         = "closeBlast";
	const CONE                = "cone";
	const LINE                = "line";
	const HAZARD              = "hazard";
	const NONE                = "none";
	const MRT_SELF            = "self";
	const SPECIAL             = "special";
	const FIELD               = "field";
	const BLESSING            = "blessing";

	public static function getRegexForType($type) : string
	{
		if($type instanceof self)
			throw new \LogicException("{$type} is not a valid move range type");

		switch($type)
		{
			case self::MELEE:
				return "/^Melee, (\d*) Targets?.*/";
			case self::RANGED:
				return "/^(\d*), (\d*) Targets?.*/";
			case self::RANGED_BLAST:
				return "/^(\d*), Ranged Blast (\d*).*/";
			case self::BURST:
				return "/^Burst (\d*).*/";
			case self::CARDINALLY_ADJACENT:
				return "/^All Cardinally Adjacent Targets.*/";
			case self::ADJACENT:
				return "/^Melee, All Adjacent Foes.*/";
			case self::CLOSE_BLAST:
				return "/^Close Blast (\d*).*/";
			case self::CONE:
				return "/^Cone (\d*).*/";
			case self::LINE:
				return "/^Line (\d*).*/";
			case self::HAZARD:
				return "/^((\d*), )?Hazard.*/";
			case self::FIELD:
				return "/^Field.*/";
			case self::BLESSING:
				return "/^Blessing.*/";
			case self::NONE:
				return "/^None.*/";
			case self::MRT_SELF:
				return "/^Self.*/";
			case self::SPECIAL:
				return "/^See Effect.*/";
		}

		throw new \LogicException("No regex for {$type} could be found");
	}

	public static function parseRangeStringForType($string)
	{
		foreach(self::cases() as $constant)
		{
			if($constant === self::PREFIX)
				continue;

			if(\preg_match(self::getRegexForType($constant), $string))
				return $constant;
		}

		throw new \LogicException($string . " could not be parsed");
	}
}