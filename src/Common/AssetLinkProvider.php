<?php

namespace PtuDex\Common;

class AssetLinkProvider extends \Engine\AssetLinkProvider
{
	public function getPokemonImgPath(\PtuDex\Common\Models\Pokemon $pokemon) : string
	{
		return \Engine\ConfigManager::getInstance()->get(\Engine\Config::HOST) . "img/pokemon/{$pokemon->id}.png";
	}
}