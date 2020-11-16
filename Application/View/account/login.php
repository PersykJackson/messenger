<?php
if($_SESSION['auth']){
    header('Location: /main/index');
}
if (count($vars['errors'])) {
    $list = '<ul>';
    foreach ($vars['errors'] as $error) {
        $list .= "<li>$error</li>";
    }
    $list .= '</ul>';
    echo $list;
}

?>

<div class="form">
    <p>Авторизация</p>
<form method="post" action="/account/login">
    <input type="text" name="login" placeholder="Логин"><br>
    <input type="password" name="password" placeholder="Пароль"><br>
    <button>Вход</button>
    <a href="/account/register">Регистрация</a>
</form>
</div>