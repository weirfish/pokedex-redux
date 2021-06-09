<?php

namespace PtuDex\Models;

class Skill extends Model
{
	public string $name = "";
	public int $rank = 0;
	public int $modifier = 0;

	public function __construct($name, $rank = 0, $modifier = 0)
	{
		if(!\PtuDex\Enums\SkillNames::isConstantValue($name))
			throw new \LogicException("Name {$name} is not a valid skill name");

		$this->name     = $name;
		$this->rank     = $rank;
		$this->modifier = $modifier;
	}
}