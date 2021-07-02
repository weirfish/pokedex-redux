<?php

namespace PtuDex\Pokedex\Elements;

class PokedexSearch extends \Engine\Page\Element\Form
{
	private string $searchString;

	public function __construct()
	{
		$this->addStyle(\PtuDex\Common\AssetLinkProvider::getInstance()->getCssPath("pokedex/pokedex-search"));
	}

	public function render(): string
	{
		// @TODO Advanced search form
		$this->setElements
		([
			\Engine\Page\Element\Input::create()
			->setName("search")
			->setType("text")
			->setPlaceholder("Type your search string here")//, or use the advanced search form")
			->setValue($this->searchString ?? null)
		]);

		$this->addAttribute(new \Engine\Page\Element\Attribute("class", "pokedex-search"));

		return parent::render();
	}

	public function setSearchString(string $searchString) : self
	{
		$this->searchString = $searchString;
	
		return $this;
	}
}