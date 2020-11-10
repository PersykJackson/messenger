<?php


namespace Liloy\Application\Core;

use Liloy\Application\Config\Registry;


class Router
{
        private $routes;
        private $route;
        private $uri;
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
            return false;
        }
        private function execute(): bool
        {
            $class = 'Liloy\\Application\\Controller\\'.ucfirst($this->route['Controller']).'Controller';
            $action = $this->route['Action'].'Action';
            if(class_exists($class)){
                if(method_exists($class, $action)){
                        $controller = new $class($this->route);
                        $controller->$action();
                        return true;
                }
                return false;
            }
            return false;
        }
        public function run(): bool
        {
            if($this->prepare()){
                if($this->execute()){
                    return true;
                }
                return false;
            }
            return false;
        }

}