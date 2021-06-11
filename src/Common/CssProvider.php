<?php

namespace PtuDex\Common;

class CssProvider
{
	use \Engine\Traits\Singleton;

	public function getMetronomeButtonCss()
	{
		return \Engine\AssetLinkProvider::getInstance()->getCssPath("metronome/metronome-button");
	}

	public function getMetronomeResultsCss()
	{
		return \Engine\AssetLinkProvider::getInstance()->getCssPath("metronome/metronome-results");
	}

	public function getPokemonTypeDecoratorCss()
	{
		return \Engine\AssetLinkProvider::getInstance()->getCssPath("common/pokemon-type-decorator");
	}

	public function getHomeCss()
	{
		return \Engine\AssetLinkProvider::getInstance()->getCssPath("home/home");
	}
}