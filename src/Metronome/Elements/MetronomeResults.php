<?php

namespace PtuDex\Metronome\Elements;

use PtuDex\Models\Move;

class MetronomeResults extends \Engine\Page\Element\ModelTable
{
	public function setMoves(Move ...$moves) : self
	{
		return $this->setModels($moves);
	}

	public function render(): string
	{
		return parent::render();
	}
}