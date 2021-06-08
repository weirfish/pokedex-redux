<?php

namespace PtuDex\Routing;

use Engine\Page\Page;

class MetronomeRoute extends \Engine\Routing\Route
{
	public static string $route = "/metronome/";

	public function getPage(): Page
	{
		return new \PtuDex\Metronome\Page();
	}
}