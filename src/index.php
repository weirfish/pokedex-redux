<?php

include "init.php";

// $route = $_SERVER['REQUEST_URI'];

// $route = \Engine\Routing\Router::getInstance()
// ->addRouteFactories(\PtuDex\Project::getInstance()->getRouteFactories())
// ->route($route);

// if($route !== null)
// 	echo $route->render();
// else echo "Problem!";

$factory = \PtuDex\Factories\MoveFactory::getInstance();

var_dump($factory->getMove("Tri Attack"));