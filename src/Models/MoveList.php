<?php

namespace PtuDex\Models;

class MoveList extends EntityList
{
	public function __construct($moves)
	{
		parent::__construct(Move::class, $moves);
	}

	public function hasMove(Move $move) : bool
	{
		return $this->hasEntity($move);
	}

	public function getMoveListEntryByName(string $name) : MoveListEntry
	{
		return $this->getEntityListEntryByProperty($name, "name");
	}

	public function getMoveByName(string $name) : Move
	{
		return $this->getMoveListEntryByName($name)->entity;
	}

	public function getMoveListEntryByMove(Move $move) : MoveListEntry
	{
		return $this->getEntityListEntryByEntity($move);
	}

	public function getMoveLevel(Move $move) : int
	{
		if(!$this->hasMove($move))
			throw new \LogicException("Move {$move->name} is not present in this move list");

		return $this->getMoveListEntryByMove($move)->level;
	}
}