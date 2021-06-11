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

			case \Engine\Database\Config::DATABASE_USER:
				return "ptudex";
			case \Engine\Database\Config::DATABASE_HOST:
				return "localhost";
			case \Engine\Database\Config::DATABASE_TABLE:
				return "ptu";
			case \Engine\Database\Config::DATABASE_PASSWORD:
				return "ptudex";
		}
	}
}