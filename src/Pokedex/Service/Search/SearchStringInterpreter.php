<?php

namespace PtuDex\Pokedex\Service\Search;

class SearchStringInterpreter
{
	private string $searchString;
	private array $rules = [];

	use \Engine\Traits\Creatable;

	public function run()
	{
		$stringParts = $this->parseSearchString();

		if(count($stringParts) == 0 || $stringParts[0] == "")
			return $this;

		foreach($stringParts as $part)
		{
			$this->rules[] = \PtuDex\Pokedex\Service\Rules\RuleFactory::getRuleForSearchStringFragment($part);
		}

		return $this;
	}

	private function parseSearchString()
	{
		$tokens = [];

		$currentToken = "";
		$depth        = 0;
		$quoting      = false;

		foreach(str_split($this->searchString) as $char)
		{
			if($char === " " && $depth === 0 && $quoting === false)
			{
				$tokens[]     = $currentToken;
				$currentToken = "";
				continue;
			}

			if($char === "(")
				$depth++;

			if($char === ")")
				$depth--;

			if($char === "\"")
				$quoting = !$quoting;
			else 
				$currentToken .= $char;
		}

		$tokens[] = $currentToken;

		return $tokens;
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