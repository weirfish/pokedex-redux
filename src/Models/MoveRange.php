<?php

namespace PtuDex\Models;

class MoveRange extends \Engine\Model\Model
{
	public string $rangeType     = \PtuDex\Enums\MoveRangeTypes::MELEE;
	public int $minimumRange     = 0;
	public int $maximumRange     = 6;
	public int $numberOfTargets = 1;

	public function __construct($type, $minRange, $maxRange, $numberOfTargets)
	{
		if(!\PtuDex\Enums\MoveRangeTypes::isConstantValue($type))
			throw new \LogicException("{$type} is not a valid move range type");

		$this->rangeType        = $type;
		$this->minimumRange     = $minRange;
		$this->maximumRange     = $maxRange;
		$this->numberOfTargets = $numberOfTargets;
	}

	public function __toString(): string
	{
		$humanReadable = \PtuDex\Enums\MoveRangeTypes::getHumanReadableText($this->rangeType);

		switch($this->rangeType)
		{
			case \PtuDex\Enums\MoveRangeTypes::MELEE:
				return $humanReadable . " " . $this->numberOfTargets;
			case \PtuDex\Enums\MoveRangeTypes::ADJACENT:
			case \PtuDex\Enums\MoveRangeTypes::BLESSING:
			case \PtuDex\Enums\MoveRangeTypes::SPECIAL:
			case \PtuDex\Enums\MoveRangeTypes::MRT_SELF:
			case \PtuDex\Enums\MoveRangeTypes::CARDINALLY_ADJACENT:
			case \PtuDex\Enums\MoveRangeTypes::FIELD:
			case \PtuDex\Enums\MoveRangeTypes::HAZARD:
			case \PtuDex\Enums\MoveRangeTypes::NONE:
				return $humanReadable;
			case \PtuDex\Enums\MoveRangeTypes::BURST:
			case \PtuDex\Enums\MoveRangeTypes::CONE:
			case \PtuDex\Enums\MoveRangeTypes::LINE:
			case \PtuDex\Enums\MoveRangeTypes::CLOSE_BLAST:
				return $humanReadable . " " . $this->maximumRange;
			case \PtuDex\Enums\MoveRangeTypes::RANGED:
				return $this->maximumRange . ", " . $humanReadable . " " . $this->numberOfTargets;
			case \PtuDex\Enums\MoveRangeTypes::RANGED_BLAST:
				return $this->minimumRange . ", " . $humanReadable . " " . $this->maximumRange;
		}
		
		return $humanReadable;
	}
}