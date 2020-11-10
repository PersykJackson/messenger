<?php


namespace Liloy\Application\Controller;

use Liloy\Application\Core\Controller;


class MainController extends Controller
{

    public function indexAction(): void
    {
        $this->view->getView();
    }
}