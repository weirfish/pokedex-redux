<?php

namespace PtuDex\Routing;

class RouteFactory extends \Engine\Routing\RouteFactory
{
	protected function defineRoutes(): array 
	{
		return
		[
			new HomeRoute()
		];
	}

}