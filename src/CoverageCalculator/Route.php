<?php

namespace PtuDex\CoverageCalculator;

use Engine\Page\Page;

class Route extends \Engine\Routing\Route
{
	public static string $route = "/coverage-calculator/";

	public function getPage(): Page
	{
		return new \PtuDex\CoverageCalculator\Page();
	}
}