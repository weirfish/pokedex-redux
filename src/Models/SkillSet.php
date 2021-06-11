<?php

namespace PtuDex\Models;

class SkillSet extends \Engine\Model\Model
{
	public $skills = [];

	public function __construct()
	{
		$this->skills = 
		[
			new Skill(\PtuDex\Enums\SkillNames::ACROBATICS),
			new Skill(\PtuDex\Enums\SkillNames::ATHLETICS),
			new Skill(\PtuDex\Enums\SkillNames::CHARM),
			new Skill(\PtuDex\Enums\SkillNames::COMBAT),
			new Skill(\PtuDex\Enums\SkillNames::COMMAND),
			new Skill(\PtuDex\Enums\SkillNames::GENERAL_EDUCATION),
			new Skill(\PtuDex\Enums\SkillNames::MEDICINE_EDUCATION),
			new Skill(\PtuDex\Enums\SkillNames::OCCULT_EDUCATION),
			new Skill(\PtuDex\Enums\SkillNames::POKEMON_EDUCATION),
			new Skill(\PtuDex\Enums\SkillNames::TECHNOLOGY_EDUCATION),
			new Skill(\PtuDex\Enums\SkillNames::FOCUS),
			new Skill(\PtuDex\Enums\SkillNames::GUILE),
			new Skill(\PtuDex\Enums\SkillNames::INTIMIDATE),
			new Skill(\PtuDex\Enums\SkillNames::INTUITION),
			new Skill(\PtuDex\Enums\SkillNames::PERCEPTION),
			new Skill(\PtuDex\Enums\SkillNames::STEALTH),
			new Skill(\PtuDex\Enums\SkillNames::SURVIVAL)
		];
	}

	public function getSkill($name) : Skill
	{
		if(!\PtuDex\Enums\SkillNames::isConstantValue($name, false))
			throw new \LogicException("{$name} is not a valid skill name");

		foreach($this->skills as $skill)
			if($skill->name = $name)
				return $skill;

		throw new \LogicException("Skill {$name} doesn't exist.");
	}

	public function setSkill($name, $rank, $modifier) : self
	{
		if(!\PtuDex\Enums\SkillNames::isConstantValue($name, false))
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