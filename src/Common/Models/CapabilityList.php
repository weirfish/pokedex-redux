<?php

namespace PtuDex\Common\Models;

class CapabilityList extends EntityList
{
	public function __construct(...$capabilities)
	{
		parent::__construct(Capability::class, $capabilities);
	}

	public function hasCapability(Capability $capability)
	{
		return $this->hasEntity($capability);
	}

	public function getCapabilityListEntryByName(string $name) : CapabilityListEntry
	{
		return $this->getEntityListEntryByProperty($name, "name");
	}

	public function getCapabilityListEntryByCapability(Capability $capability) : CapabilityListEntry
	{
		return $this->getEntityListEntryByEntity($capability);
	}

	public function getCapabilityLevel(Capability $capability) : int
	{
		if(!$this->hasCapability($capability))
			throw new \LogicException("Capability {$capability->name} is not present in this capability list");

		return $this->getCapabilityListEntryByCapability($capability)->level;
	}
}