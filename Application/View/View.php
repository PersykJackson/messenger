<?php


namespace Liloy\Application\View;


class View
{
    private $route;
    private $view;
    private $layout;

    public function __construct($route)
    {
        $this->route = $route;
        $this->render();
    }

    public function render()
    {
        ob_start();
        require_once $this->route['Controller'].'/'.$this->route['Action'].'.html';
        $this->view = ob_get_clean();
    }
    public function getView($vars = [])
    {
       echo $this->view;
    }

}