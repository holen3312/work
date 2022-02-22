<?php
spl_autoload_register(function (string $classname)
{
    require_once __DIR__ . '/' . $classname . '.php';
});

$route = $_GET['route'] ?? '';

$routes = require __DIR__ . '/routes.php';

$routeFound = false;
foreach ($routes as $pattern => $controllerAndAction) {
    preg_match($pattern, $route, $matches);
    if (!empty($matches)) {
        $routeFound = true;
        break;
    }

    if ($routeFound) {
        echo 'page not found';
    }
}
unset($matches[0]);
$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];
$controller = new $controllerName();
$controller->$actionName(...$matches);


