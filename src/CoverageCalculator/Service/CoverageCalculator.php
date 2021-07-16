<?php

namespace PtuDex\CoverageCalculator\Service;

use PtuDex\Common\Models\Move;
use \PtuDex\Common\Models\PokemonType;
use \PtuDex\Common\Models\MoveFrequency;
use \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores;
use \PtuDex\CoverageCalculator\Model\CoverageCalculatorScore;

class CoverageCalculator
{
	/** @var Move[][] */
	private array $moves;

	private bool $hasResults = false;
	private array $results;

	use \Engine\Traits\Creatable;

	public function run() : self
	{
		$this->results = [];

		foreach($this->moves as $movelist)
		{
			$scores = $this->getScores($movelist);

			if(count($movelist) > 0 && count($movelist) < 6)
				$scores = $this->getBestAddition($scores, $movelist);

			$this->results[] = $scores;
		}

		return $this;
	}

	/** @param Move[] $movelist */
	private function getScores(array $movelist) : CoverageCalculatorScores
	{
		$scores      = CoverageCalculatorScores::create();
		$typeFactory = \PtuDex\Common\Factories\TypeFactory::getInstance();

		foreach($movelist as $move)
		{
			$this->hasResults = true;

			$moveType = $move->type;

			/** @var PokemonType $type */
			foreach($typeFactory->getAllTypes() as $type)
			{
				$new_score      = $this->getScore($type, $moveType, $move->frequency);
				$existing_score = $scores->getScore($type->getName());

				// If this move gives better effectiveness, overwrite
				if($new_score->effectiveness < $existing_score->effectiveness)
					$scores->setScore($type->getName(), $new_score);

				// If it has the same effectiveness and they're both EOT, consider it at-will
				if
				(
					$new_score->effectiveness == $existing_score->effectiveness &&
					$new_score->frequency == CoverageCalculatorScore::EOT &&
					$existing_score->frequency == CoverageCalculatorScore::EOT
				)
				{
					$new_score->frequency = CoverageCalculatorScore::ATWILL;

					$scores->setScore($type->getName(), $new_score);
				}
			}
		}

		return $scores;
	}

	/** @param Move[] $movelist */
	private function getBestAddition(CoverageCalculatorScores $scores, array $movelist) : CoverageCalculatorScores
	{
		$typeFactory = \PtuDex\Common\Factories\TypeFactory::getInstance();

		$bestType    = [];
		$improvement = 0;

		/** @var PokemonType $attackingType */
		foreach($typeFactory->getAllTypes() as $attackingType)
		{
			$effectivenessImprovements = 0;

			/** @var PokemonType $defendingType */
			foreach($typeFactory->getAllTypes() as $defendingType)
			{
				$score = $this->getScore($defendingType, $attackingType, new MoveFrequency(\PtuDex\Common\Enums\MoveFrequencyTypes::AT_WILL));

				$effectivenessImprovements += max(0, $score->effectiveness - $scores->getScore($defendingType->getName())->effectiveness);
			}
			
			if($improvement < $effectivenessImprovements)
			{
				$bestType = [$attackingType];
				$improvement = $effectivenessImprovements;
			}
			else if($improvement == $effectivenessImprovements)
				$bestType[] = $attackingType;
		}
		
		if(null !== $bestType)
			$scores->bestImprovements = $bestType;

		return $scores;
	}

	private function getScore(PokemonType $activeType, PokemonType $moveType, MoveFrequency $frequency)
	{
		if($activeType->isWeakTo($moveType))
			$effectiveness_score = CoverageCalculatorScore::SUPER;
		else if($activeType->isResistantTo($moveType))
			$effectiveness_score = CoverageCalculatorScore::RESISTED;
		else if($activeType->isImmuneTo($moveType))
			$effectiveness_score = CoverageCalculatorScore::IMMUNE;
		else $effectiveness_score = CoverageCalculatorScore::NEUTRAL;

		if($frequency->type === \PtuDex\Common\Enums\MoveFrequencyTypes::AT_WILL)
			$frequency_score = CoverageCalculatorScore::ATWILL;
		else if($frequency->type === \PtuDex\Common\Enums\MoveFrequencyTypes::EOT)
			$frequency_score = CoverageCalculatorScore::EOT;
		else $frequency_score = CoverageCalculatorScore::SOMETIMES;

		return new CoverageCalculatorScore($frequency_score, $effectiveness_score);
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