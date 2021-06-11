<?php

namespace PtuDex\Common\Models;

class AbilityList extends EntityList
{
	const BASIC_ABILITY_LEVEL    = 0;
	const ADVANCED_ABILITY_LEVEL = 20;
	const HIGH_ABILITY_LEVEL     = 40;

	public function __construct(AbilityListEntry ...$abilities)
	{
		parent::__construct(Ability::class, $abilities);
	}

	public function hasAbility(Ability $ability) : bool
	{
		return $this->hasEntity($ability);
	}

	public function hasBasicAbility(Ability $ability) : bool
	{
		return $this->hasAbility($ability) && $this->getAbilityLevel($ability) === self::BASIC_ABILITY_LEVEL;
	}

	public function hasAdvancedAbility(Ability $ability) : bool
	{
		return $this->hasAbility($ability) && $this->getAbilityLevel($ability) === self::ADVANCED_ABILITY_LEVEL;
	}

	public function hasHighAbility(Ability $ability) : bool
	{
		return $this->hasAbility($ability) && $this->getAbilityLevel($ability) === self::HIGH_ABILITY_LEVEL;
	}

	public function getAbilityListEntryByName(string $name) : AbilityListEntry
	{
		return $this->getEntityListEntryByProperty($name, "name");
	}

	public function getAbilityByName(string $name) : Ability
	{
		return $this->getAbilityListEntryByName($name)->entity;
	}

	public function getAbilityListEntryByAbility(Ability $ability) : AbilityListEntry
	{
		return $this->getEntityListEntryByEntity($ability);
	}

	public function getAbilityLevel(Ability $ability) : int
	{
		if(!$this->hasAbility($ability))
			throw new \LogicException("Ability {$ability->name} is not present in this ability list");

		return $this->getAbilityListEntryByAbility($ability)->level;
	}
	
}