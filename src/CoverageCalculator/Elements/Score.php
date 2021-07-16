<?php

namespace PtuDex\CoverageCalculator\Elements;

class Score extends \Engine\Page\Element\Literal
{
	private \PtuDex\CoverageCalculator\Model\CoverageCalculatorScore $score;

	private string $immune   = "⛔";
	private string $resisted = "⚠️";
	private string $normal   = "🟢";
	private string $super    = "🔷";

	private string $atWill    = "✔️";
	private string $eot       = "〰️";
	private string $sometimes = "❌";

	public function render(): string
	{
		$contents = [];

		switch($this->score->effectiveness)
		{
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScore::IMMUNE:
				$contents[] = $this->immune; break;
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScore::RESISTED:
				$contents[] = $this->resisted; break;
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScore::NEUTRAL:
				$contents[] = $this->normal; break;
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScore::SUPER:
				$contents[] = $this->super; break;
		}

		switch($this->score->frequency)
		{
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScore::ATWILL:
				$contents[] = $this->atWill; break;
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScore::EOT:
				$contents[] = $this->eot; break;
			case \PtuDex\CoverageCalculator\Model\CoverageCalculatorScore::SOMETIMES:
				$contents[] = $this->sometimes; break;
		}

		$this->setContents(implode(" ", $contents));

		return parent::render();
	}

	public function setScore(\PtuDex\CoverageCalculator\Model\CoverageCalculatorScore $score) : self
	{
		$this->score = $score;
	
		return $this;
	}
}