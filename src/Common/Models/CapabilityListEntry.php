<?php

namespace PtuDex\Common\Models;

class CapabilityListEntry extends EntityListEntry
{
	public function __construct(Capability $capability)
	{
		parent::__construct($capability, 0);
	}
}