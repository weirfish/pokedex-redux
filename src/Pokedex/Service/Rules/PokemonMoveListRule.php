<?php

namespace PtuDex\Pokedex\Service\Rules;

use PtuDex\Common\Models\Pokemon;

class PokemonMoveListRule extends Rule
{
	use \Engine\Traits\Creatable;
	
	/** @param Pokemon $model */
	public function apply(\Engine\Model\Model $model): bool
	{
		$move = \PtuDex\Common\Factories\MoveFactory::getInstance()
		->getMove(ucwords($this->getValue()));

		$isLearn = $model->hasLearnMove($move);
		$isEgg   = $model->hasEggMove($move);
		$isHmtm  = $model->hasHmTmMove($move);
		$isTutor = $model->hasTutorMove($move);

		return $isLearn || $isEgg || $isHmtm || $isTutor;
	}
}