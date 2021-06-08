<?php

namespace PtuDex\Models;

class MoveListEntry extends EntityListEntry
{
	public function __construct(Move $move, ?int $level = null)
	{
		parent::__construct($move, $level);
	}
}