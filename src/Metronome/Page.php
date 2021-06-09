<?php

namespace PtuDex\Metronome;

class Page extends \Engine\Page\Page
{
	protected function addElements()
	{
		$this->addElement
		(
			\Engine\Page\Element\Heading::create()
			->setLevel(1)
			->setContents("PTUDex - Metronome")
		);

		$this->addElement
		(
			\Engine\Page\Element\Div::create()
			->setElements
			([
				\PtuDex\Metronome\Elements\MetronomeButton::create()
				->setNumberOfRolls(1),
				\PtuDex\Metronome\Elements\MetronomeButton::create()
				->setNumberOfRolls(2),
				\PtuDex\Metronome\Elements\MetronomeButton::create()
				->setNumberOfRolls(3),
			])
		);

		$this->addElement
		(
			\PtuDex\Metronome\Elements\MetronomeResults::create()
			->setMoves(...\PtuDex\Factories\MoveFactory::getInstance()->getAllMoves())
		);
	}
}