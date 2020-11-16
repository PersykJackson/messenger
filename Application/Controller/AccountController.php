<?php


namespace Liloy\Application\Controller;

use Liloy\Application\Core\Controller;

class AccountController extends Controller
{
    public function loginAction(): void
    {
        $result = [];
        if($_POST['login']){
            $result = $this->model->login($_POST);
            if(count($result) == 0) {
                $_SESSION['auth'] = true;
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['id'] = $_POST['id'];
                header('Location: /main/index');
            }
        }
        $this->view->getView(['errors' => $result]);
    }
    public function registerAction():void
    {
        $result = [];
        if($_POST['gender']){
            $result = $this->model->register($_POST);
            if(count($result) == 0) {
                header('Location: /account/login');
            }
        }
        $this->view->getView(['errors' => $result]);

    }
}