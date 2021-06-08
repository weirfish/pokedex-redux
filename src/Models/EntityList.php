<?php

namespace PtuDex\Models;

class EntityList
{
	public array $entity_list_entries = [];
	public string $entity_class_name  = "";

	public function __construct(String $entity_class_name, $entity_list_entries)
	{
		foreach($entity_list_entries as $entity_list_entry)
			if($entity_list_entry->entity_class_name !== $entity_class_name)
				throw new \LogicException("The entity list does not only contain {$entity_class_name}s");
		
		$this->entity_list_entries = $entity_list_entries;
		$this->entity_class_name = $entity_class_name;
	}

	public function hasEntity(Entity $entity) : bool
	{
		foreach($this->entity_list_entries as $entity_list_entry)
		{
			if($entity === $entity_list_entry->entity)
				return true;
		}

		return false;
	}

	public function getEntityListEntryByProperty(string $property, $value) : EntityListEntry
	{
		foreach($this->entity_list_entries as $entity_list_entry)
		{
			if($entity_list_entry->entry->$property === $value)
				return $entity_list_entry;
		}

		throw new \LogicException("No ability with {$property} of {$value} was found in this ability list");
	}

	public function getEntityByProperty(string $property, $value) : Entity
	{
		return $this->getEntityListEntryByProperty($property, $value)->entity;
	}

	public function getEntityListEntryByEntity(Entity $entity) : EntityListEntry
	{
		foreach($this->entity_list_entries as $entity_list_entry)
		{
			if($entity_list_entry->entity === $entity)
				return $entity_list_entry;
		}

		throw new \LogicException("The given ability was not found in this ability list");
	}

	public function getEntityLevel(Entity $entity) : int
	{
		if(!$this->hasEntity($entity))
			throw new \LogicException("Entity is not present in this ability list");

		return $this->getEntityListEntryByEntity($entity)->level;
	}

	public function toJson($name_field) : array
	{
		$json = [];

		foreach($this->entity_list_entries as $entry)
		{
			$json[] = 
			[
				$name_field => $entry->entity->name,
				"level"     => $entry->level
			];
		}

		return $json;
	}
	
}