<?php


namespace Liloy\Application\Core;


class Router
{
        private $routes;
        private $route;
        private $uri;
        public function __construct(string $uri)
        {

            $this->routes = require_once './Application/Config/Routes.php';
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
            $controller = 'Application/Controller/'.ucfirst($this->route['Controller']).'Controller.php';
            $class = 'Liloy\\Application\\Controller\\'.ucfirst($this->route['Controller']).'Controller';
            $action = $this->route['Action'].'Action';
            if(file_exists($controller)){
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