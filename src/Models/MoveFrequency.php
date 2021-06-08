<?php

namespace PtuDex\Models;

class MoveFrequency extends Model
{
	public string $type   = "";
	public int $frequency = 0;

	public function __construct($type, $frequency = 0)
	{
		if(!\PtuDex\Enums\MoveFrequencyTypes::isConstantValue($type, false))
			throw new \LogicException("Type {$type} is not a valid move frequency type.");

		$this->type      = $type;
		$this->frequency = $frequency;
	}
}