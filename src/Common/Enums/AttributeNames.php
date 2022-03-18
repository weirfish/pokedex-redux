<?php

namespace PtuDex\Common\Enums;

enum AttributeNames : string
{
	case PREFIX          = "attribute";

	case HP              = "hp";
	case ATTACK          = "attack";
	case DEFENSE         = "defense";
	case SPECIAL_ATTACK  = "special_attack";
	case SPECIAL_DEFENSE = "special_defense";
	case SPEED           = "speed";
}