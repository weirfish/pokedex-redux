<?php

namespace PtuDex\Routing;

use Engine\Page\Page;

class PokedexRoute extends \Engine\Routing\Route
{
	public static string $route = "/pokedex/";

	public function getPage(): Page
	{
		return new \PtuDex\Pokedex\Page();
	}
}