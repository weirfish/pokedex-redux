<?php

namespace PtuDex\Common\Enums;

class MoveCategories extends \Engine\Abstracts\Enum
{
	const PREFIX    = "moveCategory.";

	const SPECIAL   = "moveCategory.special";
	const PHYSICAL  = "moveCategory.physical";
	const STATUS    = "moveCategory.status";
	const MC_STATIC = "moveCategory.static";
	const NONE      = "moveCategory.none";
}