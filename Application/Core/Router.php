<?php


namespace Liloy\Application\Core;

use Liloy\Application\Config\Registry;
use Liloy\Application\Error\ErrorWriter;


class Router
{
    private $routes;
    private $route;
    private $uri;
    public $error = '';
    public function __construct(string $uri)
    {
        Registry::getInstance();
        $this->routes = Registry::getRoutes();
        $this->uri = $uri;
    }
    private function prepare(): bool
    {

        $uri = trim($this->uri, '/');
        foreach ($this->routes as $route => $arr) {
            if ($route === $uri) {
                $this->route = $arr;
                return true;
            }
        }
        $this->error .= 'Incorrect route.';
        return false;
    }
    private function execute(): bool
    {
        $class = 'Liloy\\Application\\Controller\\'.
            ucfirst($this->route['Controller']).'Controller';
        $action = $this->route['Action'].'Action';
        if (class_exists($class)) {
            if (method_exists($class, $action)) {
                $controller = new $class($this->route);
                $controller->$action();
                return true;
            }
            $this->error .= "Method $action not exist in $class";
            return false;
        }
        $this->error .= "Class $class not exist";
        return false;
    }
    public function run(): bool
    {
        if ($this->prepare()) {
            if ($this->execute()) {
                return true;
            }
            return false;
        }
        return false;
    }

}
