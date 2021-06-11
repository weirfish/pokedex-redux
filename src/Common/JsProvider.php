<?php

namespace PtuDex\Common;

class JsProvider
{
	use \Engine\Traits\Singleton;

	public function getMetronomePageScript()
	{
		return \Engine\AssetLinkProvider::getInstance()->getJsPath("metronome");
	}
}