<?php


namespace Liloy\Application\Model;


use Liloy\Application\Core\Model;

class Account extends Model
{
    private function validation(array $array): array
    {
        $errors = [];
        foreach ($array as $value) {
            if ($value == '') {
                $errors[] = 'Не все поля заполнены';
                break;
            }
        }
        if (strlen($array['password']) < 10){
            $errors[] = 'Пароль должен быть не менее 10-ти символов';
        }
        if (strlen($array['login']) < 5){
            $errors[] = 'Логин должен быть не менее 5-ти символов';
        }
        if ($array['password'] !== $array['passwordVerify']){
            $errors[] = 'Пароли не совпадают';
        }
        if (!filter_var($array['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Введен некорректный Email';
        }
        $result = $this->databaser->select('select name from usr where login = ?', [$array['login']]);
        if (count($result)) {
            $errors[] = 'Логин занят';
        }
        $result = $this->databaser->select('select name from usr where email = ?', [$array['email']]);
        if (count($result)) {
            $errors[] = 'Email занят';
        }
        return $errors;
    }
    public function register(array $array): array
    {
        $result = $this->validation($array);
        if (count($result)) {
            return $result;
        }
        $array['password'] = md5($array['password']);
        $this->databaser->insert("insert into usr(login, name, email, password, gender) 
            values(?, ?, ?, ?, ?)", [$array['login'], $array['name'], $array['email'],
            $array['password'], $array['gender']]);
        return $result;
    }
    public function login($post): array
    {
        $errors = [];
        foreach ($post as $value) {
            if($value === '') {
                $errors[] = 'Поля не могут быть пустыми';
                break;
            }
        }
        $post['password'] = md5($post['password']);
        $result = $this->databaser->select("select id from usr where login = ? and password = ?", [$post['login'], $post['password']]);
        if(!$result){
            $errors[] = 'Неверный логин или пароль';
        };
        foreach ($result as $value) {
            $_POST['id'] = $value['id'];
        }
        return $errors;
    }
}