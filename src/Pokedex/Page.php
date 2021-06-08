<?php

namespace PtuDex\Pokedex;

class Page extends \Engine\Page\Page
{
	protected function addElements()
	{
		$this->addElement
		(
			\Engine\Page\Element\Heading::create()
			->setLevel(1)
			->setContents("PTUDex - Pokedex")
		);

		$this->addElement
		(
			\PtuDex\Pokedex\Elements\PokedexSearch::create()
		);

		$this->addElement
		(
			\PtuDex\Pokedex\Elements\PokedexFilter::create()
		);

		$this->addElement
		(
			\PtuDex\Pokedex\Elements\PokedexResult::create()
		);
	}
}