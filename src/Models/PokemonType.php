<?php

namespace PtuDex\Models;

use Enums\TypeName;

class PokemonType extends Model
{
	protected string $name = "";
	protected array $weaknesses = [];
	protected array $resistances = [];
	protected array $immunities = [];

	public function __construct($name, $weaknesses = [], $resistances = [], $immunities = [])
	{
		$this->setName($name);
		$this->setWeaknesses($weaknesses);
		$this->setResistances($resistances);
		$this->setImmunities($immunities);
	}

	public function setName($name) : self
	{
		if(\PtuDex\Enums\TypeNames::isConstantValue($name))
			$this->name = $name;
		else throw new \LogicException("{$name} is not a valid type name.");

		return $this;
	}

	public function isWeakTo(PokemonType $type) : bool
	{
		return $this->isInTypeArray($type, $this->weaknesses);
	}

	public function isResistantTo(PokemonType $type) : bool
	{
		return $this->isInTypeArray($type, $this->resistances);
	}

	public function isImmuneTo(PokemonType $type) : bool
	{
		return $this->isInTypeArray($type, $this->immunities);
	}

	private function isInTypeArray(PokemonType $type, $array) : bool
	{
		foreach($array as $element)
		{
			if($element->getName() === $type->getName())
				return true;
		}

		return false;
	}

	public function addWeakness(PokemonType $type) : self
	{
		return $this->setWeaknesses(array_merge($this->weaknesses, [$type]));
	}

	public function addResistance(PokemonType $type) : self
	{
		return $this->setResistances(array_merge($this->resistances, [$type]));
	}

	public function addImmunity(PokemonType $type) : self
	{
		return $this->setImmunities(array_merge($this->immunities, [$type]));
	}

	public function setWeaknesses($weaknesses) : self
	{
		$this->assertArrayOnlyContainsTypes($weaknesses);

		$this->weaknesses = $weaknesses;

		return $this;
	}

	public function setResistances($resistances) : self
	{
		$this->assertArrayOnlyContainsTypes($resistances);

		$this->resistances = $resistances;

		return $this;
	}

	public function setImmunities($immunities) : self
	{
		$this->assertArrayOnlyContainsTypes($immunities);

		$this->immunities = $immunities;

		return $this;
	}

	private function assertArrayOnlyContainsTypes($arr) : void
	{
		foreach($arr as $k => $v)
			if(!($v instanceof static))
				throw new \LogicException("Value at position {$k} is not a {static::class}.");
	}

	public function getName() : string
	{
		return $this->name;
	}

	public function getHumanReadableName() : string
	{
		return \PtuDex\Enums\TypeNames::getHumanReadableText($this->name);
	}

	public function __debugInfo()
	{
		$rows = [];

		$rows["name"]        = $this->name;
		$rows["weakesses"]   = $this->debugArrayValue($this->weaknesses, "name");
		$rows["resistances"] = $this->debugArrayValue($this->resistances, "name");
		$rows["immunities"]  = $this->debugArrayValue($this->immunities, "name");

		return $rows;
	}
}