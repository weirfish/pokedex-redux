<?php

namespace PtuDex\CoverageCalculator\Elements;

use Engine\Page\Element\Model\DataListEntry;
use PtuDex\Common\Models\Move;

class MoveForm extends \Engine\Page\Element\Form
{
	private array $moves;

	public function render(): string
	{
		$this->usePost();

		$dataListId = "moves";

		$this->setElements
		([
			MoveColumn::create()
			->setPokemonId(1)
			->setDataListId($dataListId)
			->setMoves($this->moves[0] ?? []),
			MoveColumn::create()
			->setPokemonId(2)
			->setDataListId($dataListId)
			->setMoves($this->moves[1] ?? []),
			MoveColumn::create()
			->setPokemonId(3)
			->setDataListId($dataListId)
			->setMoves($this->moves[2] ?? []),
			MoveColumn::create()
			->setPokemonId(4)
			->setDataListId($dataListId)
			->setMoves($this->moves[3] ?? []),
			MoveColumn::create()
			->setPokemonId(5)
			->setDataListId($dataListId)
			->setMoves($this->moves[4] ?? []),
			MoveColumn::create()
			->setPokemonId(6)
			->setDataListId($dataListId)
			->setMoves($this->moves[5] ?? []),
			\Engine\Page\Element\DataList::create()
			->setOptions(...$this->getDataListEntries())
			->setId($dataListId),
		]);

		return parent::render();
	}

	private function getDataListEntries()
	{
		$moves = \PtuDex\Common\Factories\MoveFactory::getInstance()->getAllMoves();

		$dataListEntries = [];

		/** @var Move $move */
		foreach($moves as $move)
		{
			$dataListEntries[] = \Engine\Page\Element\DataListOption::create()
			->setValue($move->getName());
		}

		return $dataListEntries;
	}

	public function setMoves(array $moves) : self
	{
		$this->moves = $moves;
	
		return $this;
	}
}