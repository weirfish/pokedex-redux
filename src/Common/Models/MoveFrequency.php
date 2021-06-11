<?php

namespace PtuDex\Common\Models;

class MoveFrequency extends \Engine\Model\Model
{
	public string $type   = "";
	public int $frequency = 0;

	public function __construct($type, $frequency = 0)
	{
		if(!\PtuDex\Common\Enums\MoveFrequencyTypes::isConstantValue($type, false))
			throw new \LogicException("Type {$type} is not a valid move frequency type.");

		$this->type      = $type;
		$this->frequency = $frequency;
	}

	public function __toString()
	{
		return $this->type . ($this->frequency !== 0 ? " {$this->frequency}" : "");
	}
}