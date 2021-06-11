<?php

namespace PtuDex\Models;

class PokemonTypeSet extends Model
{
	public $types = [];

	public function __construct(PokemonType ...$types)
	{
		$this->types = $types;
	}

	public function hasType($typeToFind) : bool
	{
		if(!\Enums\TypeName::isConstantValue($typeToFind))
			throw new \LogicException("{$typeToFind} isn't a type name");

		foreach($this->types as $type)
		{
			if($type->name === $typeToFind)
				return true;
		}

		return false;
	}

	public function calculateTypeModifier(PokemonType $attackingType) : int
	{
		$immunity = false;
		$multiplier = 1;

		foreach($this->types as $defensiveType)
		{
			if($defensiveType->isImmuneTo($attackingType))
				$immunity = true;
			elseif($defensiveType->isWeakTo($attackingType))
				$multiplier++;
			elseif($defensiveType->isResistantTo($attackingType))
				$multiplier--;
		}

		if($immunity)
			return null;
		else return $multiplier;
	}
}