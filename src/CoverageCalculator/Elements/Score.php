<?php

namespace PtuDex\CoverageCalculator\Elements;

class Score extends \Engine\Page\Element\Literal
{
	private float $score;

	private string $immune      = "❌";
	private string $resisted    = "😧";
	private string $normal      = "😑";
	private string $super       = "😀";
	private string $superAlways = "🔥";

	public function render(): string
	{
		switch($this->score)
		{
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::IMMUNE:
				$this->setContents($this->immune); break;
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::RESISTED_EOT:
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::RESISTED_EVERY:
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::RESISTED_SOMETIMES:
				$this->setContents($this->resisted); break;
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::NORMAL_SOMETIMES:
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::NORMAL_EVERY:
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::NORMAL_EOT:
				$this->setContents($this->normal); break;
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::SUPER_EOT:
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::SUPER_SOMETIMES:
				$this->setContents($this->super); break;
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScores::SUPER_EVERY:
				$this->setContents($this->superAlways); break;

			default: $this->setContents($this->score); break;
		}

		return parent::render();
	}

	public function setScore(float $score) : self
	{
		$this->score = $score;
	
		return $this;
	}
}