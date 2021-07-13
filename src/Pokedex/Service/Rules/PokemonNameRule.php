<?php

namespace PtuDex\Pokedex\Service\Rules;

class PokemonNameRule extends Rule
{
	use \Engine\Traits\Creatable;

	public function apply(\Engine\Model\Model $model): bool
	{
		$result = $this->getComparatorObject()
		->check(ucwords($model->getName()));

		return $result;
	}
}