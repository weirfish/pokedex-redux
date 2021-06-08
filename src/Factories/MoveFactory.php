<?php

namespace PtuDex\Factories;

class MoveFactory extends JsonDrivenFactory
{
	protected function getPath(): string
	{
		return \Engine\Util\Paths::getDataPath() . "moves.json";
	}

	protected function validateData(array $data): bool
	{
		if(!\PtuDex\Enums\TypeNames::isConstantValue($data['type']))
			throw new \LogicException("Type {$data['type']} is not valid");

		if(!\PtuDex\Enums\MoveCategories::isConstantValue($data['category']))
			throw new \LogicException("Category {$data['category']} is not valid");


		return true;
	}

	protected function makeModel(array $data): \PtuDex\Models\Model
	{
		$freq_data    = explode(" ", $data['frequency']);
		$freq         = new \PtuDex\Models\MoveFrequency(strtolower($freq_data[0]), intval($freq_data[1] ?? 0));

		return new \PtuDex\Models\Move
		(
			$data['name'],
			TypeFactory::getInstance()->getType($data['type']),
			$data["category"] === "--" ? "none" : $data['category'],
			\PtuDex\Enums\DamageBase::getDamageBase($data["damage_base"]),
			$freq,
			$data["ac"],
			$this->getMoveRange($data),
			$data["effect"],
			$data["metronome"]
		);
	}

	protected function getMoveRange($row)
	{
		$range_string = $row['range'];
		$type = \PtuDex\Enums\MoveRangeTypes::parseRangeStringForType($range_string);
		\preg_match(\PtuDex\Enums\MoveRangeTypes::getRegexForType($type), $range_string, $range);

		$min_range = 0;
		$max_range = 6;
		$targets   = 1;

		switch($type)
		{
			case \PtuDex\Enums\MoveRangeTypes::ADJACENT:
				$min_range = 0;
				$max_range = 1;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::MELEE:
				$min_range = 0;
				$max_range = 1;
				$targets   = $range[1];
			break;
			case \PtuDex\Enums\MoveRangeTypes::RANGED:
				$min_range = 0;
				$max_range = $range[1];
				$targets   = $range[2];
			break;
			case \PtuDex\Enums\MoveRangeTypes::RANGED_BLAST:
				$min_range = $range[1];
				$max_range = $range[2];
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::BURST:
				$min_range = 0;
				$max_range = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::CARDINALLY_ADJACENT:
				$min_range = 0;
				$max_range = 1;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::ADJACENT:
				$min_range = 0;
				$max_range = 1;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::CLOSE_BLAST:
				$min_range = 0;
				$max_range = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::CONE:
				$min_range = 0;
				$max_range = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::LINE:
				$min_range = 0;
				$max_range = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::HAZARD:
				$min_range = 0;
				$max_range = $range[1] ?? 6;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::FIELD:
				$min_range = 0;
				$max_range = 100;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::BLESSING:
				$min_range = 0;
				$max_range = 100;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::NONE:
				$min_range = 0;
				$max_range = 0;
				$targets   = 1;
			break;
			case \PtuDex\Enums\MoveRangeTypes::MRT_SELF:
				$min_range = 0;
				$max_range = 0;
				$targets   = 1;
			break;
			case \PtuDex\Enums\MoveRangeTypes::SPECIAL:
				$min_range = 0;
				$max_range = 100;
				$targets   = 100;
			break;
		}

		return new \PtuDex\Models\MoveRange($type, intval($min_range), intval($max_range), intval($targets));
	}

	public function getMove(string $name) : \PtuDex\Models\Move
	{
		return $this->get($name);
	}

	public function getAllMoves() : array
	{
		return $this->getAll();
	}
}