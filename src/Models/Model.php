<?php

namespace PtuDex\Models;

abstract class Model
{
	use \Engine\Traits\Creatable;

	public function __get($property)
	{
		if(!\property_exists($this, $property))
			throw new \Exception("{$property} is not a property of " . static::class);
			
		return $this->$property;

	}

	public function __set($property, $value)
	{
		if(!\property_exists($this, $property))
			throw new \Exception("{$property} is not a property of " . static::class);

		$this->$property = $value;

		return $this;
	}

	protected function debugArrayValue($array, $property)
	{
		$vals = [];

		foreach($array as $element)
		{
			$vals[] = $element->$property;
		}

		return implode(", ", $vals);
	}
}