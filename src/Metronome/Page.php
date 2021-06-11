<?php

namespace PtuDex\Metronome;

class Page extends \Engine\Page\Page
{
	public function __construct()
	{
		parent::__construct();

		$this->addScript(\PtuDex\Common\JsProvider::getInstance()->getMetronomePageScript());
	}

	protected function addElements()
	{
		$this->addElement
		(
			\Engine\Page\Element\Heading::create()
			->setLevel(1)
			->setContents("PTUDex - Metronome Randomiser")
		);

		$this->addElement
		(
			\PtuDex\Metronome\Elements\MetronomeButtonContainer::create()
		);

		$this->addElement
		(
			\PtuDex\Metronome\Elements\MetronomeResults::create()
			->setMoves(...\PtuDex\Common\Factories\MoveFactory::getInstance()->getAllMetronomeMoves())
		);
	}
}