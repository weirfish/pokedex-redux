<?php

namespace PtuDex\Pokedex\Service\Rules;

use PtuDex\Common\Models\Pokemon;

class PokemonTypeRule extends Rule
{
	use \Engine\Traits\Creatable;

	/** @param Pokemon $model */
	public function apply(\Engine\Model\Model $model): bool
	{
		return $model->hasType("type." . $this->getValue());
	}
}