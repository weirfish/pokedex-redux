<?php

namespace PtuDex\Models;

class Ability extends Entity
{
	public array $ability_keywords = [];

	public function __construct($name, $description, AbilityKeyword ...$ability_keywords)
	{
		parent::__construct($name, $description);

		$this->ability_keywords = $ability_keywords;
	}
}