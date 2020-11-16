<?php if(empty($_SESSION['auth'])){
    header('Location: /account/login');
}
?>
<div class="wrapper">
    <div class="header">
        <h2>Messenger</h2>
        <div class="exit" onclick="logout()">Выход</div>
    </div>
    <div class="content">
    <div class="menu">
        <ul>
            <li onclick="get('news')">Новости</li>
            <li onclick="get('contacts')">Мои контакты</li>
            <li onclick="get('chats')">Чаты</li>
            <li onclick="get('profile')">Моя страница</li>
        </ul>
    </div>
    <div class="body"><?=$vars['news']?></div>
    </div>
</div>