<?php

namespace PtuDex\Metronome;

use Engine\Page\Page;

class Route extends \Engine\Routing\Route
{
	public static string $route = "/metronome/";

	public function getPage(): Page
	{
		return new \PtuDex\Metronome\Page();
	}
}