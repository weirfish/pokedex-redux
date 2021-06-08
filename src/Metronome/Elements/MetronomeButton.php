<?php

namespace PtuDex\Metronome\Elements;

class MetronomeButton extends \Engine\Page\Element\Button
{
	private int $number_of_rolls;

	public function render(): string
	{
		$this->setContents("Waggle your fingers {$this->getAmountString()}!");

		return parent::render();
	}

	private function getAmountString()
	{
		switch($this->number_of_rolls)
		{
			case 1: return "once";
			case 2: return "twice";
			case 3: return "thrice";
		}
	}

	public function setNumberOfRolls(int $number_of_rolls) : self
	{
		if($number_of_rolls < 1 || $number_of_rolls > 3)
			throw new \LogicException("Metronome can only be run 1, 2, or 3 times");

		$this->number_of_rolls = $number_of_rolls;
	
		return $this;
	}
}