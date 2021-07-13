<?php

namespace PtuDex\CoverageCalculator\Elements;

class MoveColumn extends \Engine\Page\Element\Fieldset
{
	private int $pokemonId;
	private string $dataListId;
	private array $moves;

	public function render(): string
	{
		$this->addElement
		(
			\Engine\Page\Element\Legend::create()
			->setValue("Pokemon {$this->pokemonId}")
		);

		$this->addElement($this->getInput($this->moves, 0));
		$this->addElement($this->getInput($this->moves, 1));
		$this->addElement($this->getInput($this->moves, 2));
		$this->addElement($this->getInput($this->moves, 3));
		$this->addElement($this->getInput($this->moves, 4));
		$this->addElement($this->getInput($this->moves, 5));

		return parent::render();
	}

	private function getInput(array $moves, int $index) : \Engine\Page\Element\Input
	{
		$move = isset($moves[$index]) ? $moves[$index] : null;

		return \Engine\Page\Element\Input::create()
		->setType("text")
		->setDataList($this->dataListId)
		->setName("move[{$this->pokemonId}][]")
		->setPlaceholder("Type a move, or leave blank")
		->setValue($move?->getName());
	}

	public function setPokemonId(int $pokemonId) : self
	{
		$this->pokemonId = $pokemonId;
	
		return $this;
	}
	public function setDataListId(string $dataListId) : self
	{
		$this->dataListId = $dataListId;
	
		return $this;
	}
	public function setMoves(array $moves) : self
	{
		$this->moves = $moves;
	
		return $this;
	}
}