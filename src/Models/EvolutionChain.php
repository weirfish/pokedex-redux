<?php

namespace PtuDex\Models;

class EvolutionChain extends EntityList
{
	public function __construct($evolution_chain_entry)
	{
		parent::__construct(Pokemon::class, $evolution_chain_entry);
	}

	public function hasPokemon(Pokemon $pokemon) : bool
	{
		return $this->hasEntity($pokemon);
	}

	public function getPreviousEvo(Pokemon $root_pokemon) : ?Pokemon
	{
		if(!$this->hasPokemon($root_pokemon))
			throw new \Exception("{$root_pokemon->name} is not present in this pokemon list");

		foreach($this->entity_list_entries as $key => $pokemon)
		{
			if($pokemon->entity->name === $root_pokemon->name && $key >= 1)
				return $this->entity_list_entries[$key - 1];
		}

		return null;
	}

	public function getNextEvo(Pokemon $root_pokemon) : ?Pokemon
	{
		if(!$this->hasPokemon($root_pokemon))
			throw new \Exception("{$root_pokemon->name} is not present in this pokemon list");

		foreach($this->entity_list_entries as $key => $pokemon)
		{
			if($pokemon->entity->name === $root_pokemon->name && $key < count($this->entity_list_entries) - 1)
				return $this->entity_list_entries[$key + 1];
		}

		return null;
	}

	public function getPokemonListEntryByName(string $name) : EvolutionChainEntry
	{
		return $this->getEntityListEntryByProperty($name, "name");
	}

	public function getPokemonByName(string $name) : Pokemon
	{
		return $this->getPokemonListEntryByName($name)->pokemon;
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