<?php


namespace Liloy\Application\Controller;


use Liloy\Application\Core\Controller;
use Liloy\Application\Error\ErrorResponser;

class AjaxController extends Controller
{
    public function indexAction(): void
    {
        if(!$_POST){
            ErrorResponser::getError(404, 'Incorrect route');
        }else{
            $action = $_POST['Action'];
            $this->model->$action($_POST['Val']);
        }
    }
}