<?php

namespace PtuDex;

class ConfigProvider extends \Engine\ConfigProvider
{
	public function get($key)
	{
		switch($key)
		{
			case \Engine\Config::HOST:
				return "http://ptudex.beta/";

			case \Engine\Config::PAGE_DEFAULT_TEMPLATE:
				return \PtuDex\Routing\Template::getInstance();
		}
	}

}