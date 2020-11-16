<?php
if($_SESSION['auth']){
    header('Location: /main/index');
};
if (count($vars['errors'])) {
    $list = '<ul>';
    foreach ($vars['errors'] as $error) {
        $list .= "<li>$error</li>";
    }
    $list .= '</ul>';
    echo $list;
}
?>

<form class="form" method="post" action="/account/register">
    <p>Регистрация</p>
    <input type="text" name="login" placeholder="Логин"><br>
    <input type="text" name="name" placeholder="Имя"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Пароль"><br>
    <input type="password" name="passwordVerify" placeholder="Подтверждение пароля"><br>
    <select name="gender">
        <option value="male">Мужской</option>
        <option value="female">Женский</option>
    </select><br>
    <button type="submit">Зарегистрироваться</button>
    <a href="/account/login">Вход</a>
</form>
