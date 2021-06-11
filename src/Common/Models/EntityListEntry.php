<?php

namespace PtuDex\Common\Models;

class EntityListEntry
{
	public ?Entity $entity            = null;
	public ?int $level                = null;
	public ?string $entityClassName = null;

	public function __construct(Entity $entity, ?int $level = null)
	{
		$this->entity            = $entity;
		$this->level             = $level;
		$this->entityClassName = get_class($entity);
	}
}