<?php

namespace PtuDex\Common\Enums;

class SkillNames extends \Engine\Abstracts\Enum
{
	const PREFIX               = "skill";

	const ACROBATICS           = "acrobatics";
	const ATHLETICS            = "athletics";
	const CHARM                = "charm";
	const COMBAT               = "combat";
	const COMMAND              = "command";
	const GENERAL_EDUCATION    = "generalEducation";
	const MEDICINE_EDUCATION   = "medicineEducation";
	const OCCULT_EDUCATION     = "occultEducation";
	const POKEMON_EDUCATION    = "pokemonEducation";
	const TECHNOLOGY_EDUCATION = "technologyEducation";
	const FOCUS                = "focus";
	const GUILE                = "guile";
	const INTIMIDATE           = "intimidate";
	const INTUITION            = "intuition";
	const PERCEPTION           = "perception";
	const STEALTH              = "stealth";
	const SURVIVAL             = "survival";

	public static function getBodySkills() : array
	{
		return
		[
			self::ACROBATICS,
			self::ATHLETICS,
			self::COMBAT,
			self::INTIMIDATE,
			self::STEALTH,
			self::SURVIVAL,
		];
	}

	public static function getMindSkills() : array
	{
		return
		[
			self::GENERAL_EDUCATION,
			self::MEDICINE_EDUCATION,
			self::OCCULT_EDUCATION,
			self::POKEMON_EDUCATION,
			self::TECHNOLOGY_EDUCATION,
			self::GUILE,
			self::PERCEPTION,
		];
	}

	public static function getSocialSkills() : array
	{
		return
		[
			self::CHARM,
			self::COMMAND,
			self::FOCUS,
			self::INTUITION,
		];
	}

	public static function isBodySkill($val) : bool
	{
		return static::isSkillFromCategory($val, static::getBodySkills());
	}

	public static function isMindSkill($val) : bool
	{
		return static::isSkillFromCategory($val, static::getMindSkills());
	}

	public static function isSocialSkill($val) : bool
	{
		return static::isSkillFromCategory($val, static::getSocialSkills());
	}

	protected static function isSkillFromCategory($val, $categorySkills) : bool
	{
		if(!static::isConstantValue($val))
			throw new \Exception("Given value {$val} is not a skill.");

		return in_array($val, $categorySkills);
	}
}