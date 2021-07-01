<?php

namespace PtuDex\Pokedex\Elements;

use PtuDex\Common\Models\Pokemon;

class PokedexResult extends \Engine\Page\Element\Div
{
	/** @var Pokemon[] */
	private array $pokemon;

	public function render(): string
	{
		foreach($this->pokemon as $pokemon)
		{
			$this->addElement
			(
				PokemonSummary::create()
				->setPokemon($pokemon)
			);
		}

		return parent::render();
	}

	public function setPokemon(array $pokemon) : self
	{
		$this->pokemon = $pokemon;
	
		return $this;
	}
}