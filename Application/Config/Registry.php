<?php


namespace Liloy\Application\Config;


use Liloy\Application\Core\Controller;

class Registry
{
    private static $instance = null;
    private static $routes = [];

    public static function getInstance(): self
    {
        if(is_null(self::$instance)){
            self::$instance = new Registry();
            self::$routes = require_once 'Routes.php';
        }
        return self::$instance;
    }
    public static function getRoutes(): array
    {
        return self::$routes;
    }
}