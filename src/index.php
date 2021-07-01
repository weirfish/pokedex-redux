<?php

include "init.php";

\Engine\ConfigManager::getInstance()
->addConfigProvider(new \PtuDex\ConfigProvider())
->addConfigProvider(new \Engine\ConfigProvider());

$request = $_SERVER['REQUEST_URI'];

if(str_contains($request, "?"))
	[$route, $query_string] = explode("?", $_SERVER['REQUEST_URI']);
else $route = $request;

$route = \Engine\Routing\Router::getInstance()
->addRouteFactories(\PtuDex\Project::getInstance()->getRouteFactories())
->route($route)
->setGet($_GET)
->setPost($_POST);

if($route !== null)
	echo $route->render();
else echo "Problem!";