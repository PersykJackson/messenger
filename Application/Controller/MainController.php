<?php


namespace Liloy\Application\Controller;


class MainController
{
    public $route;
    public $model;
    public $path;
    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $this->route['Controller'].'php';
        $model = 'Liloy\\Application\\Model\\'.ucfirst($this->route['Controller']);
        if(class_exists($model)){
            $this->model = new $model();
        }
    }

    public function indexAction()
    {
        echo '123';
    }
}