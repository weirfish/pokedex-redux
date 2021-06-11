<?php

include "init.php";

\Engine\ConfigManager::getInstance()
->addConfigProvider(new \PtuDex\ConfigProvider())
->addConfigProvider(new \Engine\ConfigProvider());

// [$route, $query_string] = explode("?", $_SERVER['REQUEST_URI']);

// $route = \Engine\Routing\Router::getInstance()
// ->addRouteFactories(\PtuDex\Project::getInstance()->getRouteFactories())
// ->route($route)
// ->setGet($_GET)
// ->setPost($_POST);

// if($route !== null)
// 	echo $route->render();
// else echo "Problem!";

$cm = \Engine\Database\ConnectionManager::getInstance();

$query = new \Engine\Database\Query\CreateTableQuery();

$row = new \Engine\Database\Model\RowDefinition();

$row->name = "id";
$row->type = "int";

$query->setTableName("move")
->setRowDefinitions
([
	$row
]);

$cm->execute($query);