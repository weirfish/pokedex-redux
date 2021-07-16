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
			->setContents("Pokedex")
		);

		try
		{
			$rules        = \PtuDex\Pokedex\Service\Search\SearchStringInterpreter::create()
			->setSearchString($this->get['search'] ?? "")
			->run()
			->getRules();

			// @TODO Make criteria for factories
			$pokemon = \PtuDex\Pokedex\Service\Filters\Filter::create()
			->setRules($rules)
			->setModels($poke_factory->getAllPokemon())
			->filter();
		}
		catch(\Exception $e)
		{
			$this->get['search'] == "";

			$exceptionMessage = $e->getMessage();

			$pokemon = $poke_factory->getAllPokemon();
		}

		$paginationCount = count($pokemon);

		$this->addElement
		(
			\PtuDex\Pokedex\Elements\PokedexSearch::create()
			->setSearchString($this->get['search'] ?? "")
		);

		if(isset($exceptionMessage))
		{
			$this->addElement
			(
				\Engine\Page\Element\Div::create()
				->addElement
				(
					\Engine\Page\Element\Literal::create()
					->setContents("There was a problem with your request: {$exceptionMessage}")
				)
				->addAttribute(new \Engine\Page\Element\Attribute("class", "warning"))
			);

		}

		$currentPage = \Engine\Routing\Url::currentPage()->getQueryValue("page") ?? 1;
		$currentPage--;

		$pokemon = array_slice($pokemon, $currentPage * self::ITEMS_PER_PAGE, self::ITEMS_PER_PAGE);

		$this->addElement
		(
			\PtuDex\Pokedex\Elements\PokedexResult::create()
			->setPokemon($pokemon)
		);

		$this->addElement
		(
			\Engine\Page\Element\PaginationElement::create()
			->setItemCount($paginationCount)
			->setItemsPerPage(self::ITEMS_PER_PAGE)
			->setPageOffset(\Engine\Routing\Url::currentPage()->getQueryValue("page") ?? 1)
			->setPagesEitherSide(self::PAGES_TO_PAGINATE)
		);
	}
}