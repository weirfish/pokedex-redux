<?php

namespace PtuDex\Common\Models;

class SkillSet extends \Engine\Model\Model
{
	public $skills = [];

	public function __construct()
	{
		$this->skills = 
		[
			new Skill(\PtuDex\Common\Enums\SkillNames::ACROBATICS),
			new Skill(\PtuDex\Common\Enums\SkillNames::ATHLETICS),
			new Skill(\PtuDex\Common\Enums\SkillNames::CHARM),
			new Skill(\PtuDex\Common\Enums\SkillNames::COMBAT),
			new Skill(\PtuDex\Common\Enums\SkillNames::COMMAND),
			new Skill(\PtuDex\Common\Enums\SkillNames::GENERAL_EDUCATION),
			new Skill(\PtuDex\Common\Enums\SkillNames::MEDICINE_EDUCATION),
			new Skill(\PtuDex\Common\Enums\SkillNames::OCCULT_EDUCATION),
			new Skill(\PtuDex\Common\Enums\SkillNames::POKEMON_EDUCATION),
			new Skill(\PtuDex\Common\Enums\SkillNames::TECHNOLOGY_EDUCATION),
			new Skill(\PtuDex\Common\Enums\SkillNames::FOCUS),
			new Skill(\PtuDex\Common\Enums\SkillNames::GUILE),
			new Skill(\PtuDex\Common\Enums\SkillNames::INTIMIDATE),
			new Skill(\PtuDex\Common\Enums\SkillNames::INTUITION),
			new Skill(\PtuDex\Common\Enums\SkillNames::PERCEPTION),
			new Skill(\PtuDex\Common\Enums\SkillNames::STEALTH),
			new Skill(\PtuDex\Common\Enums\SkillNames::SURVIVAL)
		];
	}

	public function getSkill($name) : Skill
	{
		if(!\PtuDex\Common\Enums\SkillNames::isConstantValue($name, false))
			throw new \LogicException("{$name} is not a valid skill name");

		foreach($this->skills as $skill)
			if($skill->name = $name)
				return $skill;

		throw new \LogicException("Skill {$name} doesn't exist.");
	}

	public function setSkill($name, $rank, $modifier) : self
	{
		if(!\PtuDex\Common\Enums\SkillNames::isConstantValue($name, false))
			throw new \LogicException("{$name} is not a valid skill name");

		foreach($this->skills as $skill)
		{
			if($skill->name == $name)
			{
				$skill->rank     = $rank;
				$skill->modifier = $modifier;
				break;
			}
		}

		return $this;
	}
}