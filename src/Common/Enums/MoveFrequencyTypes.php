<?php

namespace PtuDex\Common\Enums;

enum MoveFrequencyTypes : string
{
	const PREFIX    = "moveFrequencyTypes";

	const AT_WILL   = "at-will";
	const EOT       = "eot";
	const SCENE     = "scene";
	const DAILY     = "daily";
	const SPECIAL   = "special";
	const MF_STATIC = "static";
}