<?php

include "init.php";

\Engine\ConfigManager::getInstance()
->addConfigProvider(new \PtuDex\ConfigProvider())
->addConfigProvider(new \Engine\ConfigProvider());

$route = $_SERVER['REQUEST_URI'];

$route = \Engine\Routing\Router::getInstance()
->addRouteFactories(\PtuDex\Project::getInstance()->getRouteFactories())
->route($route);

if($route !== null)
	echo $route->render();
else echo "Problem!";