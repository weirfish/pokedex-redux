<?php

namespace PtuDex\Models;

class EntityListEntry
{
	public ?Entity $entity            = null;
	public ?int $level                = null;
	public ?string $entity_class_name = null;

	public function __construct(Entity $entity, ?int $level = null)
	{
		$this->entity            = $entity;
		$this->level             = $level;
		$this->entity_class_name = get_class($entity);
	}
}