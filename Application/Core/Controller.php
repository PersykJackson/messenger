<?php


namespace Liloy\Application\Core;


use Liloy\Application\Config\Registry;
use Liloy\Application\View\View;

class Controller
{
    public $model;
    public $route;
    public $path;
    public $view;
    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->path = $this->route['Controller'].'.php';
        $model = 'Liloy\\Application\\Model\\'.ucfirst($this->route['Controller']);
        if(class_exists($model)){
            $this->model = new $model();
        }
        $this->view->getView(['1' => 22]);

    }
}