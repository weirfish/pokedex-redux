<?php

namespace PtuDex\CoverageCalculator\Model;

class CoverageCalculatorScores extends \Engine\Model\Model
{
	const SUPER_EVERY        = 1;
	const SUPER_EOT          = 2;
	const SUPER_SOMETIMES    = 3;
	const NORMAL_EVERY       = 4;
	const NORMAL_EOT         = 5;
	const NORMAL_SOMETIMES   = 6;
	const RESISTED_EVERY     = 7;
	const RESISTED_EOT       = 8;
	const RESISTED_SOMETIMES = 9;
	const IMMUNE             = 10;

	public float $normal   = self::IMMUNE;
	public float $fire     = self::IMMUNE;
	public float $fighting = self::IMMUNE;
	public float $water    = self::IMMUNE;
	public float $flying   = self::IMMUNE;
	public float $grass    = self::IMMUNE;
	public float $poison   = self::IMMUNE;
	public float $electric = self::IMMUNE;
	public float $ground   = self::IMMUNE;
	public float $psychic  = self::IMMUNE;
	public float $rock     = self::IMMUNE;
	public float $ice      = self::IMMUNE;
	public float $bug      = self::IMMUNE;
	public float $dragon   = self::IMMUNE;
	public float $ghost    = self::IMMUNE;
	public float $dark     = self::IMMUNE;
	public float $steel    = self::IMMUNE;
	public float $fairy    = self::IMMUNE;

	use \Engine\Traits\Creatable;
}