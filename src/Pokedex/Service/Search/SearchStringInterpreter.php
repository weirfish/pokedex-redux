<?php

namespace PtuDex\Pokedex\Service\Search;

class SearchStringInterpreter
{
	private string $searchString;
	private array $rules = [];

	use \Engine\Traits\Creatable;

	public function run()
	{
		$stringParts = explode(" ", $this->searchString);

		if(count($stringParts) == 0 || $stringParts[0] == "")
			return $this;

		foreach($stringParts as $part)
		{
			$this->rules[] = \PtuDex\Pokedex\Service\Rules\RuleFactory::getRuleForSearchStringFragment($part);
		}

		return $this;
	}
	
	public function getRules() : array
	{
		return $this->rules;
	}

	public function setSearchString(string $searchString) : self
	{
		$this->searchString = $searchString;
	
		return $this;
	}
}