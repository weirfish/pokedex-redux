<?php

namespace PtuDex\Metronome\Elements;

class MetronomeButton extends \Engine\Page\Element\Button
{
	private int $numberOfRolls;

	public function render(): string
	{
		$this->setContents("Waggle your fingers {$this->getAmountString()}!");

		$this->addAttribute(new \Engine\Page\Element\Attribute("data-rolls", $this->numberOfRolls));

		return parent::render();
	}

	private function getAmountString()
	{
		switch($this->numberOfRolls)
		{
			case 1: return "once";
			case 2: return "twice";
			case 3: return "thrice";
		}
	}

	public function setNumberOfRolls(int $numberOfRolls) : self
	{
		if($numberOfRolls < 1 || $numberOfRolls > 3)
			throw new \LogicException("Metronome can only be run 1, 2, or 3 times");

		$this->numberOfRolls = $numberOfRolls;
	
		return $this;
	}
}