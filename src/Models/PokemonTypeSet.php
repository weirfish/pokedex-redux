<?php

namespace PtuDex\Models;

class PokemonTypeSet extends Model
{
	public $types = [];

	public function __construct(PokemonType ...$types)
	{
		$this->types = $types;
	}

	public function hasType($type_to_find) : bool
	{
		if(!\Enums\TypeName::isConstantValue($type_to_find))
			throw new \LogicException("{$type_to_find} isn't a type name");

		foreach($this->types as $type)
		{
			if($type->name === $type_to_find)
				return true;
		}

		return false;
	}

	public function calculateTypeModifier(PokemonType $attacking_type) : int
	{
		$immunity = false;
		$multiplier = 1;

		foreach($this->types as $defensive_type)
		{
			if($defensive_type->isImmuneTo($attacking_type))
				$immunity = true;
			elseif($defensive_type->isWeakTo($attacking_type))
				$multiplier++;
			elseif($defensive_type->isResistantTo($attacking_type))
				$multiplier--;
		}

		if($immunity)
			return null;
		else return $multiplier;
	}
}