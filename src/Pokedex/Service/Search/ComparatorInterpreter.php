<?php

namespace PtuDex\Pokedex\Service\Search;

class ComparatorInterpreter
{
	private string $searchStringPart;

	use \Engine\Traits\Creatable;

	public function run()
	{
		return $this->checkForComparators($this->getContainsComparators()) ??
			$this->checkForComparators($this->getNumericComparators()) ??
			[Terms::NAME, ":", $this->searchStringPart];
	}

	private function checkForComparators(array $comparators) : ?array
	{
		preg_match($this->getRegex($comparators), $this->searchStringPart, $matches);

		if(count($matches) > 0)
			return preg_split($this->getRegex($comparators), $this->searchStringPart, -1, PREG_SPLIT_DELIM_CAPTURE);

		return null;
	}

	private function getRegex($comparatorList)
	{
		return "/([(" . implode(")|(", $comparatorList) . ")])/";
	}

	private function getContainsComparators()
	{
		return [":"];
	}

	private function getNumericComparators()
	{
		return ["=","<",">","<=",">="];
	}

	public function setSearchStringPart(string $searchStringPart) : self
	{
		$this->searchStringPart = $searchStringPart;
	
		return $this;
	}
}