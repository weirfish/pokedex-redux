<?php

namespace PtuDex\Common\Models;

class Entity extends \Engine\Model\Model
{
	public $name = "";
	public $description = "";

	public function __construct($name, $description)
	{
		$this->name        = $name;
		$this->description = $description;
	}

	public function getName() : string
	{
		return $this->name;
	}

	public function __toString()
	{
		return $this->name;
	}
}