<?php

namespace PtuDex\Common\Models;

class MoveRange extends \Engine\Model\Model
{
	public string $rangeType     = \PtuDex\Common\Enums\MoveRangeTypes::MELEE;
	public int $minimumRange     = 0;
	public int $maximumRange     = 6;
	public int $numberOfTargets = 1;

	public function __construct($type, $minRange, $maxRange, $numberOfTargets)
	{
		if(!\PtuDex\Common\Enums\MoveRangeTypes::isConstantValue($type))
			throw new \LogicException("{$type} is not a valid move range type");

		$this->rangeType        = $type;
		$this->minimumRange     = $minRange;
		$this->maximumRange     = $maxRange;
		$this->numberOfTargets = $numberOfTargets;
	}

	public function __toString(): string
	{
		$humanReadable = \PtuDex\Common\Enums\MoveRangeTypes::getHumanReadableText($this->rangeType);

		switch($this->rangeType)
		{
			case \PtuDex\Common\Enums\MoveRangeTypes::MELEE:
				return $humanReadable . " " . $this->numberOfTargets;
			case \PtuDex\Common\Enums\MoveRangeTypes::ADJACENT:
			case \PtuDex\Common\Enums\MoveRangeTypes::BLESSING:
			case \PtuDex\Common\Enums\MoveRangeTypes::SPECIAL:
			case \PtuDex\Common\Enums\MoveRangeTypes::MRT_SELF:
			case \PtuDex\Common\Enums\MoveRangeTypes::CARDINALLY_ADJACENT:
			case \PtuDex\Common\Enums\MoveRangeTypes::FIELD:
			case \PtuDex\Common\Enums\MoveRangeTypes::HAZARD:
			case \PtuDex\Common\Enums\MoveRangeTypes::NONE:
				return $humanReadable;
			case \PtuDex\Common\Enums\MoveRangeTypes::BURST:
			case \PtuDex\Common\Enums\MoveRangeTypes::CONE:
			case \PtuDex\Common\Enums\MoveRangeTypes::LINE:
			case \PtuDex\Common\Enums\MoveRangeTypes::CLOSE_BLAST:
				return $humanReadable . " " . $this->maximumRange;
			case \PtuDex\Common\Enums\MoveRangeTypes::RANGED:
				return $this->maximumRange . ", " . $humanReadable . " " . $this->numberOfTargets;
			case \PtuDex\Common\Enums\MoveRangeTypes::RANGED_BLAST:
				return $this->minimumRange . ", " . $humanReadable . " " . $this->maximumRange;
		}
		
		return $humanReadable;
	}
}