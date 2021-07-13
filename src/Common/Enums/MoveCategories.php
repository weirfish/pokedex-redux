<?php

namespace PtuDex\Common\Enums;

class MoveCategories extends \Engine\Abstracts\Enum
{
	const PREFIX    = "moveCategory";

	const SPECIAL   = "special";
	const PHYSICAL  = "physical";
	const STATUS    = "status";
	const MC_STATIC = "static";
	const NONE      = "none";
}