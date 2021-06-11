<?php

namespace PtuDex\Home;

use Engine\Page\Page;

class Route extends \Engine\Routing\Route
{
	public static string $route = "/";

	public function getPage(): Page
	{
		return new \PtuDex\Home\Page();
	}
}