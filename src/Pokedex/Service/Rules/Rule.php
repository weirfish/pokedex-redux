<?php

namespace PtuDex\Pokedex\Service\Rules;

abstract class Rule
{
	private mixed $value;
	private string $comparator;
	
	public function getComparator() : string
	{
		return $this->comparator;
	}
	public function setComparator(string $comparator) : self
	{
		$this->comparator = $comparator;
	
		return $this;
	}
	public function getValue() : mixed
	{
		return $this->value;
	}
	public function setValue(mixed $value) : self
	{
		$this->value = $value;
	
		return $this;
	}

	abstract public function apply(\Engine\Model\Model $model);

	protected function getComparatorObject() : \Engine\Comparator\Comparator
	{
		return \Engine\Comparator\Comparator::create()
		->setComparator($this->comparator)
		->setObjective($this->value);
	}
}