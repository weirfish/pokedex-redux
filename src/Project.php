<?php

namespace PtuDex;

class Project extends \Engine\Project
{
	use \Engine\Traits\Singleton;

	/**
	 * @return \Engine\Routing\RouteFactory[]
	 */
	public function getRouteFactories() : array
	{
		return 
		[
			new \PtuDex\Routing\RouteFactory()
		];
	}
}