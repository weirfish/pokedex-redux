<?php

namespace PtuDex\CoverageCalculator\Service;

use PtuDex\Common\Models\Move;
use \PtuDex\Common\Models\PokemonType;
use \PtuDex\Common\Models\MoveFrequency;

class CoverageCalculator
{
	/** @var Move[][] */
	private array $moves;

	private bool $hasResults = false;
	private array $results;

	use \Engine\Traits\Creatable;

	public function run() : self
	{
		$typeFactory = \PtuDex\Common\Factories\TypeFactory::getInstance();
		$scores = [];

		foreach($this->moves as $movelist)
		{
			$score = \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::create();

			foreach($movelist as $move)
			{
				if($move->damage === \PtuDex\Common\Enums\DamageBase::DB0)
					continue;

				$this->hasResults = true;

				$moveType = $move->type;

				foreach(\PtuDex\Common\Enums\TypeNames::getConstants() as $key => $value)
				{
					$activeType = $typeFactory->getType($value);

					$moveScore = $this->getScore($activeType, $moveType, $move->frequency);

					$new_score = min($score->$value ?? PHP_INT_MAX, $moveScore, 10);

					$score->$value = $new_score;
				}
			}

			$scores[] = $score;
		}

		$this->results = $scores;

		return $this;
	}

	private function getScore(PokemonType $activeType, PokemonType $moveType, MoveFrequency $frequency)
	{
		if($activeType->isWeakTo($moveType))
			$effectiveness_score = 1;
		else if($activeType->isResistantTo($moveType))
			$effectiveness_score = 4;
		else if($activeType->isImmuneTo($moveType))
			$effectiveness_score = 8;
		else $effectiveness_score = 2;

		if($frequency->type === \PtuDex\Common\Enums\MoveFrequencyTypes::AT_WILL)
			$frequency_score = 16;
		else if($frequency->type === \PtuDex\Common\Enums\MoveFrequencyTypes::EOT)
			$frequency_score = 32;
		else $frequency_score = 64;

		switch($effectiveness_score | $frequency_score)
		{
			case 1 | 16:
				return \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::SUPER_EVERY;
			case 1 | 32:
				return \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::SUPER_EOT;
			case 1 | 64:
				return \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::SUPER_SOMETIMES;
			case 2 | 16:
				return \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::NORMAL_EVERY;
			case 2 | 32:
				return \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::NORMAL_EOT;
			case 2 | 64:
				return \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::NORMAL_SOMETIMES;
			case 4 | 16:
				return \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::RESISTED_EVERY;
			case 4 | 32:
				return \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::RESISTED_EOT;
			case 4 | 64:
				return \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::RESISTED_SOMETIMES;
			default: return \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::IMMUNE;
		}
	}

	public function hasResults() : bool
	{
		return $this->hasResults;
	}
	public function getResults() : array
	{
		return $this->results;
	}
	public function setMoves(array $moves) : self
	{
		$this->moves = $moves;
	
		return $this;
	}
}