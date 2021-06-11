<?php

namespace PtuDex\Metronome\Elements;

use PtuDex\Common\Models\Move;

class MetronomeResults extends \Engine\Page\Element\ModelTable
{
	public function __construct()
	{
		$this->addDecorator("type", new \PtuDex\Common\Elements\PokemonTypeSetDecorator());
		$this->addDecorator("category", new \PtuDex\Common\Elements\MoveCategoryDecorator());
		$this->addDecorator("damage", new \PtuDex\Common\Elements\DamageBaseDecorator());
		$this->addDecorator("stabDamage", new \PtuDex\Common\Elements\DamageBaseDecorator());
		$this->addDecorator("ac", new \PtuDex\Common\Elements\AcDecorator());

		$this->addAttribute(new \Engine\Page\Element\Attribute("id", "metronome-results"));

		$this->addStyle(\PtuDex\Common\CssProvider::getInstance()->getMetronomeResultsCss());
	}

	public function setMoves(Move ...$moves) : self
	{
		$models = [];
		
		foreach($moves as $move)
		{
			$models[] = \PtuDex\Metronome\Model\MetronomeResult::fromMove($move);
		}

		return $this->setModels($models);
	}

	public function render(): string
	{
		return parent::render();
	}
}