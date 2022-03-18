<?php

namespace PtuDex\Common\Enums;

enum MoveCategories : string
{
	const PREFIX    = "moveCategory";

	const SPECIAL   = "special";
	const PHYSICAL  = "physical";
	const STATUS    = "status";
	const MC_STATIC = "static";
	const NONE      = "none";
}