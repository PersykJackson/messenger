<?php


namespace Liloy\Application\View;


class View
{
    private $route;
    private $view;
    public $layout = 'default';
    public $style = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->prepare();
    }

    private function prepare(): void
    {
            ob_start();
            require_once $this->route['Controller'].'/'.$this->route['Action'].
                '.php';
            $this->view = ob_get_clean();
    }
    public function getView($vars = []): bool
    {
        $vars['view'] = $this->view;
        $vars['title'] = $this->route['Title'];
        $vars['style'] = $this->style;
        if (require_once 'layouts/'.$this->layout.'.php') {
            return true;
        };
        return false;
    }

}
