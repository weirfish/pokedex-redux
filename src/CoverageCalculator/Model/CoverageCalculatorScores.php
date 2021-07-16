<?php

namespace PtuDex\CoverageCalculator\Model;

use PtuDex\Common\Models\PokemonType;

class CoverageCalculatorScores extends \Engine\Model\Model
{
	public CoverageCalculatorScore $normal;
	public CoverageCalculatorScore $fire;
	public CoverageCalculatorScore $fighting;
	public CoverageCalculatorScore $water;
	public CoverageCalculatorScore $flying;
	public CoverageCalculatorScore $grass;
	public CoverageCalculatorScore $poison;
	public CoverageCalculatorScore $electric;
	public CoverageCalculatorScore $ground;
	public CoverageCalculatorScore $psychic;
	public CoverageCalculatorScore $rock;
	public CoverageCalculatorScore $ice;
	public CoverageCalculatorScore $bug;
	public CoverageCalculatorScore $dragon;
	public CoverageCalculatorScore $ghost;
	public CoverageCalculatorScore $dark;
	public CoverageCalculatorScore $steel;
	public CoverageCalculatorScore $fairy;

	/** @var PokemonType[] */
	public array $bestImprovements = [];
	/** @var PokemonType[] */
	public array $bestReplacements = [];

	use \Engine\Traits\Creatable;

	public function __construct()
	{
		$this->normal   = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->fire     = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->fighting = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->water    = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->flying   = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->grass    = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->poison   = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->electric = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->ground   = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->psychic  = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->rock     = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->ice      = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->bug      = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->dragon   = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->ghost    = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->dark     = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->steel    = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
		$this->fairy    = new CoverageCalculatorScore(CoverageCalculatorScore::SOMETIMES, CoverageCalculatorScore::IMMUNE);
	}

	public function getScore($typeName) : CoverageCalculatorScore
	{
		return $this->$typeName;
	}
	
	public function setScore(string $typeName, CoverageCalculatorScore $score) : self
	{
		$this->$typeName = $score;

		return $this;
	}

	public function getScores()
	{
		return
		[
			\PtuDex\Common\Enums\TypeNames::NORMAL   => $this->normal,
			\PtuDex\Common\Enums\TypeNames::FIRE     => $this->fire,
			\PtuDex\Common\Enums\TypeNames::FIGHTING => $this->fighting,
			\PtuDex\Common\Enums\TypeNames::WATER    => $this->water,
			\PtuDex\Common\Enums\TypeNames::FLYING   => $this->flying,
			\PtuDex\Common\Enums\TypeNames::GRASS    => $this->grass,
			\PtuDex\Common\Enums\TypeNames::POISON   => $this->poison,
			\PtuDex\Common\Enums\TypeNames::ELECTRIC => $this->electric,
			\PtuDex\Common\Enums\TypeNames::GROUND   => $this->ground,
			\PtuDex\Common\Enums\TypeNames::PSYCHIC  => $this->psychic,
			\PtuDex\Common\Enums\TypeNames::ROCK     => $this->rock,
			\PtuDex\Common\Enums\TypeNames::ICE      => $this->ice,
			\PtuDex\Common\Enums\TypeNames::BUG      => $this->bug,
			\PtuDex\Common\Enums\TypeNames::DRAGON   => $this->dragon,
			\PtuDex\Common\Enums\TypeNames::GHOST    => $this->ghost,
			\PtuDex\Common\Enums\TypeNames::DARK     => $this->dark,
			\PtuDex\Common\Enums\TypeNames::STEEL    => $this->steel,
			\PtuDex\Common\Enums\TypeNames::FAIRY    => $this->fairy,
		];
	}
}