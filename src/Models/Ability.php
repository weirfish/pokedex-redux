<?php

namespace PtuDex\Models;

class Ability extends Entity
{
	public array $abilityKeywords = [];

	public function __construct($name, $description, AbilityKeyword ...$abilityKeywords)
	{
		parent::__construct($name, $description);

		$this->abilityKeywords = $abilityKeywords;
	}
}