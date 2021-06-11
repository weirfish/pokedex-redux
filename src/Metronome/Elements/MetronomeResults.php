<?php

namespace PtuDex\Metronome\Elements;

use PtuDex\Models\Move;

class MetronomeResults extends \Engine\Page\Element\ModelTable
{
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