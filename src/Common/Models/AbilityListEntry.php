<?php

namespace PtuDex\Common\Models;

class AbilityListEntry extends EntityListEntry
{
	public function __construct(Ability $ability, ?int $level = null)
	{
		parent::__construct($ability, $level);
	}
}