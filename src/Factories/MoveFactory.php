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
		$freqData    = explode(" ", $data['frequency']);
		$freq         = new \PtuDex\Models\MoveFrequency(strtolower($freqData[0]), intval($freqData[1] ?? 0));

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
		$rangeString = $row['range'];
		$type = \PtuDex\Enums\MoveRangeTypes::parseRangeStringForType($rangeString);
		\preg_match(\PtuDex\Enums\MoveRangeTypes::getRegexForType($type), $rangeString, $range);

		$minRange = 0;
		$maxRange = 6;
		$targets   = 1;

		switch($type)
		{
			case \PtuDex\Enums\MoveRangeTypes::ADJACENT:
				$minRange = 0;
				$maxRange = 1;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::MELEE:
				$minRange = 0;
				$maxRange = 1;
				$targets   = $range[1];
			break;
			case \PtuDex\Enums\MoveRangeTypes::RANGED:
				$minRange = 0;
				$maxRange = $range[1];
				$targets   = $range[2];
			break;
			case \PtuDex\Enums\MoveRangeTypes::RANGED_BLAST:
				$minRange = $range[1];
				$maxRange = $range[2];
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::BURST:
				$minRange = 0;
				$maxRange = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::CARDINALLY_ADJACENT:
				$minRange = 0;
				$maxRange = 1;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::ADJACENT:
				$minRange = 0;
				$maxRange = 1;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::CLOSE_BLAST:
				$minRange = 0;
				$maxRange = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::CONE:
				$minRange = 0;
				$maxRange = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::LINE:
				$minRange = 0;
				$maxRange = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::HAZARD:
				$minRange = 0;
				$maxRange = $range[1] ?? 6;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::FIELD:
				$minRange = 0;
				$maxRange = 100;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::BLESSING:
				$minRange = 0;
				$maxRange = 100;
				$targets   = 100;
			break;
			case \PtuDex\Enums\MoveRangeTypes::NONE:
				$minRange = 0;
				$maxRange = 0;
				$targets   = 1;
			break;
			case \PtuDex\Enums\MoveRangeTypes::MRT_SELF:
				$minRange = 0;
				$maxRange = 0;
				$targets   = 1;
			break;
			case \PtuDex\Enums\MoveRangeTypes::SPECIAL:
				$minRange = 0;
				$maxRange = 100;
				$targets   = 100;
			break;
		}

		return new \PtuDex\Models\MoveRange($type, intval($minRange), intval($maxRange), intval($targets));
	}

	public function getMove(string $name) : \PtuDex\Models\Move
	{
		$move = $this->get($name);
		
		if(null === $move)
			throw new \LogicException("Move {$name} not found");

		return $move;
	}

	public function getAllMoves() : array
	{
		return $this->getAll();
	}
}