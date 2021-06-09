<?php

namespace PtuDex\Enums;

class SkillNames extends \Engine\Abstracts\Enum
{
	const ACROBATICS           = "skill.acrobatics";
	const ATHLETICS            = "skill.athletics";
	const CHARM                = "skill.charm";
	const COMBAT               = "skill.combat";
	const COMMAND              = "skill.command";
	const GENERAL_EDUCATION    = "skill.generalEducation";
	const MEDICINE_EDUCATION   = "skill.medicineEducation";
	const OCCULT_EDUCATION     = "skill.occultEducation";
	const POKEMON_EDUCATION    = "skill.pokemonEducation";
	const TECHNOLOGY_EDUCATION = "skill.technologyEducation";
	const FOCUS                = "skill.focus";
	const GUILE                = "skill.guile";
	const INTIMIDATE           = "skill.intimidate";
	const INTUITION            = "skill.intuition";
	const PERCEPTION           = "skill.perception";
	const STEALTH              = "skill.stealth";
	const SURVIVAL             = "skill.survival";

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

	protected static function isSkillFromCategory($val, $category_skills) : bool
	{
		if(!static::isConstantValue($val))
			throw new \Exception("Given value {$val} is not a skill.");

		return in_array($val, $category_skills);
	}
}