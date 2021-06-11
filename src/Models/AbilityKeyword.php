<?php

namespace PtuDex\Models;

class AbilityKeyword
{
	public String $name         = "";
	public String $description  = "";
	public $effectTarget = null;

	public function __construct($name, $description, $effectTarget = null)
	{
		$this->name          = $name;
		$this->description   = $description;
		$this->effectTarget = $effectTarget;
	}
}