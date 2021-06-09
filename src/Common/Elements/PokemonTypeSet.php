<?php

namespace PtuDex\Common\Elements;

class PokemonTypeSet extends \Engine\Page\Element\Div
{
	private \PtuDex\Models\PokemonTypeSet $pokemon_type_set;
	
	public function render() : string
	{
		$elements = [];

		foreach($this->pokemon_type_set->types as $type)
		{
			$elements[] = \Engine\Page\Element\Div::create()
			->addElement
			(
				(new \Engine\Page\Element\Literal)
				->setContents($type->getHumanReadableName())
			)
			->addAttribute(new \Engine\Page\Element\Attribute("class", "type-{$type->getName()}"));
		}

		$this->setElements($elements);

		return parent::render();
	}

	public function setPokemonTypeSet(\PtuDex\Models\PokemonTypeSet $pokemon_type_set) : self
	{
		$this->pokemon_type_set = $pokemon_type_set;
	
		return $this;
	}
}