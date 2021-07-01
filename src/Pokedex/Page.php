<?php

namespace PtuDex\Pokedex;

class Page extends \Engine\Page\Page
{
	private const ITEMS_PER_PAGE    = 10;
	private const PAGES_TO_PAGINATE = 3;

	protected function addElements()
	{
		$poke_factory = \PtuDex\Common\Factories\PokemonFactory::getInstance();

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

		// @TODO Make criteria for factories
		$pokemon = $poke_factory->getAllPokemon();
		$current_page = \Engine\Routing\Url::currentPage()->getQueryValue("page") ?? 1;
		$current_page--;

		$pokemon = array_slice($pokemon, $current_page * self::ITEMS_PER_PAGE, self::ITEMS_PER_PAGE);

		$this->addElement
		(
			\PtuDex\Pokedex\Elements\PokedexResult::create()
			->setPokemon($pokemon)
		);

		$this->addElement
		(
			\Engine\Page\Element\PaginationElement::create()
			->setItemCount($poke_factory->countAll())
			->setItemsPerPage(self::ITEMS_PER_PAGE)
			->setPageOffset(\Engine\Routing\Url::currentPage()->getQueryValue("page") ?? 1)
			->setPagesEitherSide(self::PAGES_TO_PAGINATE)
		);
	}
}