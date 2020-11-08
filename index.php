<?php
require_once 'vendor/autoload.php';

use Liloy\Application\Core\Router;

$router = new Router($_SERVER['REQUEST_URI']);
$router->run();