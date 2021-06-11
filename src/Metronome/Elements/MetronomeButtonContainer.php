<?php

namespace PtuDex\Metronome\Elements;

class MetronomeButtonContainer extends \Engine\Page\Element\Div
{
	public function __construct()
	{
		$this->addStyle(\PtuDex\Common\CssProvider::getInstance()->getMetronomeButtonCss());

		$this->addAttribute(new \Engine\Page\Element\Attribute("id", "metronome-button-container"));
	}

	public function render(): string
	{
		$this->setElements
		([
			\PtuDex\Metronome\Elements\MetronomeButton::create()
			->setNumberOfRolls(1),
			\PtuDex\Metronome\Elements\MetronomeButton::create()
			->setNumberOfRolls(2),
			\PtuDex\Metronome\Elements\MetronomeButton::create()
			->setNumberOfRolls(3),
		]);
		return parent::render();
	}
}