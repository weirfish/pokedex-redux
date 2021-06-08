<?php

namespace PtuDex\Models;

class AbilityKeyword
{
	public String $name         = "";
	public String $description  = "";
	public $effect_target = null;

	public function __construct($name, $description, $effect_target = null)
	{
		$this->name          = $name;
		$this->description   = $description;
		$this->effect_target = $effect_target;
	}
}