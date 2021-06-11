<?php

namespace PtuDex\Models;

class EntityList
{
	public array $entityListEntries = [];
	public string $entityClassName  = "";

	public function __construct(String $entityClassName, $entityListEntries)
	{
		foreach($entityListEntries as $entityListEntry)
			if($entityListEntry->entityClassName !== $entityClassName)
				throw new \LogicException("The entity list does not only contain {$entityClassName}s");
		
		$this->entityListEntries = $entityListEntries;
		$this->entityClassName = $entityClassName;
	}

	public function hasEntity(Entity $entity) : bool
	{
		foreach($this->entityListEntries as $entityListEntry)
		{
			if($entity === $entityListEntry->entity)
				return true;
		}

		return false;
	}

	public function getEntityListEntryByProperty(string $property, $value) : EntityListEntry
	{
		foreach($this->entityListEntries as $entityListEntry)
		{
			if($entityListEntry->entry->$property === $value)
				return $entityListEntry;
		}

		throw new \LogicException("No ability with {$property} of {$value} was found in this ability list");
	}

	public function getEntityByProperty(string $property, $value) : Entity
	{
		return $this->getEntityListEntryByProperty($property, $value)->entity;
	}

	public function getEntityListEntryByEntity(Entity $entity) : EntityListEntry
	{
		foreach($this->entityListEntries as $entityListEntry)
		{
			if($entityListEntry->entity === $entity)
				return $entityListEntry;
		}

		throw new \LogicException("The given ability was not found in this ability list");
	}

	public function getEntityLevel(Entity $entity) : int
	{
		if(!$this->hasEntity($entity))
			throw new \LogicException("Entity is not present in this ability list");

		return $this->getEntityListEntryByEntity($entity)->level;
	}

	public function toJson($nameField) : array
	{
		$json = [];

		foreach($this->entityListEntries as $entry)
		{
			$json[] = 
			[
				$nameField => $entry->entity->name,
				"level"     => $entry->level
			];
		}

		return $json;
	}
	
}