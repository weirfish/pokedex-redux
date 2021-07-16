<?php

namespace PtuDex\Common\Models;

class EvolutionChain extends EntityList
{
	public function __construct(...$evolution_chain_entry)
	{
		parent::__construct(Pokemon::class, ...$evolution_chain_entry);
	}

	public function hasPokemon(Pokemon $pokemon) : bool
	{
		return $this->hasEntity($pokemon);
	}

	public function getPreviousEvo(Pokemon $rootPokemon) : ?Pokemon
	{
		if(!$this->hasPokemon($rootPokemon))
			throw new \Exception("{$rootPokemon->name} is not present in this pokemon list");

		foreach($this->entityListEntries as $key => $pokemon)
		{
			if($pokemon->entity->name === $rootPokemon->name && $key >= 1)
				return $this?->entityListEntries[$key - 1]?->entity ?? null;
		}

		return null;
	}

	public function getNextEvo(Pokemon $rootPokemon) : ?Pokemon
	{
		if(!$this->hasPokemon($rootPokemon))
			throw new \Exception("{$rootPokemon->name} is not present in this pokemon list");

		foreach($this->entityListEntries as $key => $pokemon)
		{
			if($pokemon->entity->name === $rootPokemon->name && $key < count($this->entityListEntries) - 1)
				return $this->entityListEntries[$key + 1];
		}

		return null;
	}

	public function getPokemonListEntryByName(string $name) : EvolutionChainEntry
	{
		return $this->getEntityListEntryByProperty($name, "name");
	}

	public function getPokemonByName(string $name) : Pokemon
	{
		return $this->getPokemonListEntryByName($name)->entity;
	}

	public function getPokemonListEntryByPokemon(Pokemon $pokemon) : EvolutionChainEntry
	{
		return $this->getEntityListEntryByEntity($pokemon);
	}

	public function getPokemonLevel(Pokemon $pokemon) : int
	{
		if(!$this->hasPokemon($pokemon))
			throw new \LogicException("Pokemon {$pokemon->name} is not present in this pokemon list");

		return $this->getPokemonListEntryByPokemon($pokemon)->level;
	}
}