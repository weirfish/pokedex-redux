<?php

namespace PtuDex\Common\Models;

class Capability extends Entity
{
	public $value = null;

	public function __construct($name, $description, $value = null)
	{
		parent::__construct($name, $description);
		
		$this->value = $value;
	}
}