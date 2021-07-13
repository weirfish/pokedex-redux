<?php

namespace PtuDex\Routing;

class RouteFactory extends \Engine\Routing\RouteFactory
{
	protected function defineRoutes(): array 
	{
		return
		[
			new \PtuDex\Home\Route(),
			new \PtuDex\Metronome\Route(),
			new \PtuDex\Pokedex\Route(),
			new \PtuDex\CoverageCalculator\Route(),
		];
	}

}