<?php

namespace PtuDex\CoverageCalculator\Model;

class CoverageCalculatorScore extends \Engine\Model\Model
{
	const SUPER    = 1;
	const NEUTRAL  = 2;
	const RESISTED = 4;
	const IMMUNE   = 8;

	const ATWILL    = 16;
	const EOT       = 32;
	const SOMETIMES = 64;

	public int $frequency;
	public int $effectiveness;

	public function __construct(int $frequency, int $effectiveness)
	{
		$this->frequency    = $frequency;
		$this->effectiveness = $effectiveness;
	}
}