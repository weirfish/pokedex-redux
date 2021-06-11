<?php

namespace PtuDex\Pokedex;

use Engine\Page\Page;

class Route extends \Engine\Routing\Route
{
	public static string $route = "/pokedex/";

	public function getPage(): Page
	{
		return new \PtuDex\Pokedex\Page();
	}
}