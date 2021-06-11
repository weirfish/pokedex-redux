<?php

namespace PtuDex\Common\Factories;

use PtuDex\Common\Models\Move;

class MoveFactory extends JsonDrivenFactory
{
	protected function getPath(): string
	{
		return \Engine\Util\Paths::getDataPath() . "moves.json";
	}

	protected function validateData(array $data): bool
	{
		if(!\PtuDex\Common\Enums\TypeNames::isConstantValue($data['type']))
			throw new \LogicException("Type {$data['type']} is not valid");

		if(!\PtuDex\Common\Enums\MoveCategories::isConstantValue($data['category']))
			throw new \LogicException("Category {$data['category']} is not valid");


		return true;
	}

	protected function makeModel(array $data): \Engine\Model\Model
	{
		$freqData    = explode(" ", $data['frequency']);
		$freq         = new \PtuDex\Common\Models\MoveFrequency(strtolower($freqData[0]), intval($freqData[1] ?? 0));

		return new \PtuDex\Common\Models\Move
		(
			$data['name'],
			TypeFactory::getInstance()->getType($data['type']),
			$data["category"] === "--" ? "none" : $data['category'],
			\PtuDex\Common\Enums\DamageBase::getDamageBase($data["damage_base"]),
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
		$type = \PtuDex\Common\Enums\MoveRangeTypes::parseRangeStringForType($rangeString);
		\preg_match(\PtuDex\Common\Enums\MoveRangeTypes::getRegexForType($type), $rangeString, $range);

		$minRange = 0;
		$maxRange = 6;
		$targets   = 1;

		switch($type)
		{
			case \PtuDex\Common\Enums\MoveRangeTypes::ADJACENT:
				$minRange = 0;
				$maxRange = 1;
				$targets   = 100;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::MELEE:
				$minRange = 0;
				$maxRange = 1;
				$targets   = $range[1];
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::RANGED:
				$minRange = 0;
				$maxRange = $range[1];
				$targets   = $range[2];
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::RANGED_BLAST:
				$minRange = $range[1];
				$maxRange = $range[2];
				$targets   = 100;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::BURST:
				$minRange = 0;
				$maxRange = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::CARDINALLY_ADJACENT:
				$minRange = 0;
				$maxRange = 1;
				$targets   = 100;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::ADJACENT:
				$minRange = 0;
				$maxRange = 1;
				$targets   = 100;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::CLOSE_BLAST:
				$minRange = 0;
				$maxRange = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::CONE:
				$minRange = 0;
				$maxRange = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::LINE:
				$minRange = 0;
				$maxRange = $range[1];
				$targets   = 100;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::HAZARD:
				$minRange = 0;
				$maxRange = $range[1] ?? 6;
				$targets   = 100;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::FIELD:
				$minRange = 0;
				$maxRange = 100;
				$targets   = 100;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::BLESSING:
				$minRange = 0;
				$maxRange = 100;
				$targets   = 100;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::NONE:
				$minRange = 0;
				$maxRange = 0;
				$targets   = 1;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::MRT_SELF:
				$minRange = 0;
				$maxRange = 0;
				$targets   = 1;
			break;
			case \PtuDex\Common\Enums\MoveRangeTypes::SPECIAL:
				$minRange = 0;
				$maxRange = 100;
				$targets   = 100;
			break;
		}

		return new \PtuDex\Common\Models\MoveRange($type, intval($minRange), intval($maxRange), intval($targets));
	}

	public function getMove(string $name) : \PtuDex\Common\Models\Move
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

	public function getAllMetronomeMoves() : array
	{
		$moves = [];

		/** @var Move $move */
		foreach($this->getAll() as $move)
		{
			if($move->getIsMetronome())
				$moves[] = $move;
		}

		return $moves;
	}
}