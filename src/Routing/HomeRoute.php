<?php

namespace PtuDex\Routing;

use Engine\Page\Page;

class HomeRoute extends \Engine\Routing\Route
{
	public static string $route = "/";

	public function getPage(): Page
	{
		return new \PtuDex\Home\Page();
	}
}