<?php

namespace PtuDex\Routing;

use Engine\Page\Page;

class HomeRoute extends \Engine\Routing\Route
{
	protected static string $route = "/";

	public function getPage(): Page
	{
		return new \PtuDex\Home\Page();
	}
}