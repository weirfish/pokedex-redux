<?php

namespace PtuDex\Models;

class MoveRange extends Model
{
	public string $range_type     = \PtuDex\Enums\MoveRangeTypes::MELEE;
	public int $minimum_range     = 0;
	public int $maximum_range     = 6;
	public int $number_of_targets = 1;

	public function __construct($type, $min_range, $max_range, $number_of_targets)
	{
		if(!\PtuDex\Enums\MoveRangeTypes::isConstantValue($type))
			throw new \LogicException("{$type} is not a valid move range type");

		$this->range_type        = $type;
		$this->minimum_range     = $min_range;
		$this->maximum_range     = $max_range;
		$this->number_of_targets = $number_of_targets;
	}

	public function __toString(): string
	{
		$human_readable = \PtuDex\Enums\MoveRangeTypes::getHumanReadableText($this->range_type);

		switch($this->range_type)
		{
			case \PtuDex\Enums\MoveRangeTypes::MELEE:
				return $human_readable . " " . $this->number_of_targets;
			case \PtuDex\Enums\MoveRangeTypes::ADJACENT:
			case \PtuDex\Enums\MoveRangeTypes::BLESSING:
			case \PtuDex\Enums\MoveRangeTypes::SPECIAL:
			case \PtuDex\Enums\MoveRangeTypes::MRT_SELF:
			case \PtuDex\Enums\MoveRangeTypes::CARDINALLY_ADJACENT:
			case \PtuDex\Enums\MoveRangeTypes::FIELD:
			case \PtuDex\Enums\MoveRangeTypes::HAZARD:
			case \PtuDex\Enums\MoveRangeTypes::NONE:
				return $human_readable;
			case \PtuDex\Enums\MoveRangeTypes::BURST:
			case \PtuDex\Enums\MoveRangeTypes::CONE:
			case \PtuDex\Enums\MoveRangeTypes::LINE:
			case \PtuDex\Enums\MoveRangeTypes::CLOSE_BLAST:
				return $human_readable . " " . $this->maximum_range;
			case \PtuDex\Enums\MoveRangeTypes::RANGED:
				return $this->maximum_range . ", " . $human_readable . " " . $this->number_of_targets;
			case \PtuDex\Enums\MoveRangeTypes::RANGED_BLAST:
				return $this->minimum_range . ", " . $human_readable . " " . $this->maximum_range;
		}
	}
}