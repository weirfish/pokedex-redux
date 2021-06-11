<?php

namespace PtuDex\Common\Models;

class EvolutionChainEntry extends EntityListEntry
{
	public function __construct(Pokemon $pokemon, int $level)
	{
		parent::__construct($pokemon, $level);
	}
}