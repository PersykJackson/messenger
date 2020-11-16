<?php


namespace Liloy\Application\View;


class View
{
    private $route;
    public $layout = 'default';
    public $style = 'default';

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function getView($vars = []): bool
    {
        ob_start();
        require_once $this->route['Controller'].'/'.$this->route['Action'].
            '.php';

        $vars['view'] =  ob_get_clean();
        $vars['title'] = $this->route['Title'];
        $vars['style'] = $this->route['Controller'];
        if (require_once 'layouts/'.$this->layout.'.php') {
            return true;
        };
        return false;
    }

}
