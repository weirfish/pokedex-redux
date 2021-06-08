<?php

namespace PtuDex\Pokedex\Elements;

class PokedexFilter extends \Engine\Page\Element\Div
{
	public function render(): string
	{
		$this->setElements
		([
			\Engine\Page\Element\Literal::create()
			->setContents("This is a pokedex filter")
		]);

		return parent::render();
	}
}