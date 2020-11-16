<?php
require_once '../vendor/autoload.php';

use Liloy\Application\Core\Router;
use Liloy\Application\Error\ErrorResponser;

session_start();
$router = new Router($_SERVER['REQUEST_URI']);
$router->run();
if ($router->error !== ''){
    \Liloy\Application\Error\ErrorResponser::getError(404, $router->error);
}