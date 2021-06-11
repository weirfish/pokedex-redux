<?php

namespace PtuDex\Common\Enums;

class MoveRangeTypes extends \Engine\Abstracts\Enum
{
	const PREFIX              = "moveRangeTypes.";

	const MELEE               = "moveRangeTypes.melee";
	const RANGED              = "moveRangeTypes.ranged";
	const RANGED_BLAST        = "moveRangeTypes.rangedBlast";
	const BURST               = "moveRangeTypes.burst";
	const CARDINALLY_ADJACENT = "moveRangeTypes.cardinallyAdjacent";
	const ADJACENT            = "moveRangeTypes.adjacent";
	const CLOSE_BLAST         = "moveRangeTypes.closeBlast";
	const CONE                = "moveRangeTypes.cone";
	const LINE                = "moveRangeTypes.line";
	const HAZARD              = "moveRangeTypes.hazard";
	const NONE                = "moveRangeTypes.none";
	const MRT_SELF            = "moveRangeTypes.self";
	const SPECIAL             = "moveRangeTypes.special";
	const FIELD               = "moveRangeTypes.field";
	const BLESSING            = "moveRangeTypes.blessing";

	public static function getRegexForType($type) : string
	{
		if(!self::isConstantValue($type))
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
		foreach(self::getConstants() as $constant)
		{
			if($constant === self::PREFIX)
				continue;

			if(\preg_match(self::getRegexForType($constant), $string))
				return $constant;
		}

		throw new \LogicException($string . " could not be parsed");
	}
}