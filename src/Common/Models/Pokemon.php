<?php

namespace PtuDex\Common\Models;

class Pokemon extends Entity
{
	public int $id                   = 0;
	public ?PokemonTypeSet $types    = null;
	public ?AttributeSet $attributes = null;
	public ?SkillSet $skills         = null;

	public ?MoveList $learnMoves = null;
	public ?MoveList $tutorMoves = null;
	public ?MoveList $hmtmMoves  = null;
	public ?MoveList $eggMoves   = null;

	public ?AbilityList $abilities       = null;
	public ?CapabilityList $capabilities = null;
	public ?EvolutionChain $evolution    = null;

	public function hasType($type) : bool
	{
		if(!\PtuDex\Common\Enums\TypeNames::isConstantValue($type))
			throw new \LogicException("{$type} isn't a type name");

		return $this->types->hasType($type);
	}

	public function hasMove(Move $move) : bool
	{
		return $this->hasLearnMove($move) || $this->hasTutorMove($move) || $this->hasHmTmMove($move) || $this->hasEggMove($move);
	}

	public function hasLearnMove(Move $move) : bool
	{
		return $this->learnMoves->hasMove($move);
	}

	public function hasTutorMove(Move $move) : bool
	{
		return $this->tutorMoves->hasMove($move);
	}

	public function hasEggMove(Move $move) : bool
	{
		return $this->eggMoves->hasMove($move);
	}

	public function hasHmTmMove(Move $move) : bool
	{
		return $this->hmtmMoves->hasMove($move);
	}

	public function hasCapability(Capability $capability) : bool
	{
		return $this->capabilities->hasCapability($capability);
	}

	public function hasAbility(Ability $ability) : bool
	{
		return $this->abilities->hasAbility($ability);
	}

	public function hasBasicAbility(Ability $ability) : bool
	{
		return $this->abilities->hasBasicAbility($ability);
	}

	public function hasAdvancedAbility(Ability $ability) : bool
	{
		return $this->abilities->hasAdvancedAbility($ability);
	}

	public function hasHighAbility(Ability $ability) : bool
	{
		return $this->abilities->hasHighAbility($ability);
	}

	public function getAllLearnMovesToEvo() : array
	{
		$moves = [];

		$moves = [...$moves, ...$this->learnMoves->getMoves()];

		if($this->evolution?->getPreviousEvo($this) !== null)
		{
			$moves = [...$moves, ...$this->evolution->getPreviousEvo($this)->getAllLearnMovesToEvo()];
		}

		return $moves;
	}

	public function getAllEggMovesToEvo() : array
	{
		$moves = [];

		$moves = [...$moves, ...$this->eggMoves->getMoves()];

		if($this->evolution?->getPreviousEvo($this) !== null)
		{
			$moves = [...$moves, ...$this->evolution->getPreviousEvo($this)->getAllEggMovesToEvo()];
		}

		return $moves;
	}

	public function getAllHmtmMovesToEvo() : array
	{
		$moves = [];

		$moves = [...$moves, ...$this->hmtmMoves->getMoves()];

		if($this->evolution?->getPreviousEvo($this) !== null)
		{
			$moves = [...$moves, ...$this->evolution->getPreviousEvo($this)->getAllHmtmMovesToEvo()];
		}

		return $moves;
	}

	public function getAllTutorMovesToEvo() : array
	{
		$moves = [];

		$moves = [...$moves, ...$this->tutorMoves->getMoves()];

		if($this->evolution?->getPreviousEvo($this) !== null)
		{
			$moves = [...$moves, ...$this->evolution->getPreviousEvo($this)->getAllTutorMovesToEvo()];
		}

		return $moves;
	}

	public function getAllMovesToEvo() : array
	{
		return
		[
			...$this->getAllLearnMovesToEvo(),
			...$this->getAllEggMovesToEvo(),
			...$this->getAllHmtmMovesToEvo(),
			...$this->getAllTutorMovesToEvo(),
		];
	}
}