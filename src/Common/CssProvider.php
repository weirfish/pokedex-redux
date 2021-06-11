<?php

namespace PtuDex\Common;

class CssProvider
{
	use \Engine\Traits\Singleton;

	public function getMetronomeButtonCss()
	{
		return \Engine\AssetLinkProvider::getInstance()->getCssPath("metronome-button");
	}

	public function getMetronomeResultsCss()
	{
		return \Engine\AssetLinkProvider::getInstance()->getCssPath("metronome-results");
	}

	public function getPokemonTypeDecoratorCss()
	{
		return \Engine\AssetLinkProvider::getInstance()->getCssPath("pokemon-type-decorator");
	}
}