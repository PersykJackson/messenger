<?php


namespace Liloy\Application\Core;


use Liloy\Application\Error\ErrorResponser;
use Liloy\Application\View\View;

class Controller
{
    public $model;
    public $route;
    public $path;
    public $view;
    public function __construct(array $route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->path = $this->route['Controller'].'.php';
        $model = 'Liloy\\Application\\Model\\'.ucfirst($this->route['Controller']);
        if(class_exists($model)){
            $this->model = new $model();
        }else{
            ErrorResponser::getError("Model $model not exist");
        }
    }
}