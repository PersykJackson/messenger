<?php


namespace Liloy\Application\Model;


use Liloy\Application\Core\Model;

class Ajax extends Model
{
    public function logout()
    {
        $_SESSION['auth'] = false;
        $_SESSION['login'] = false;
        $_SESSION['id'] = false;
    }
    public function news()
    {
        $main = new Main();
        echo $main->getNews();
    }
    public function contacts()
    {
        $code = "<div class='contacts'>
            <div class='message'></div>
            <div class='add'><input class='friendLogin' type='text' placeholder='Введите логин'></div><div class='friends'><br><button class='addFriend' onclick='addFriend()'>Добавить контакт</button><br>";
        $contacts = $this->databaser->select("select * from contacts where login = '{$_SESSION['login']}'");
        foreach ($contacts as $contact) {
            $code .= "<button class='friend' value='{$contact['friendId']}' onclick='getTalk(this)'>".$contact['friendLogin']."</button><br>";
        }
        $contacts = $this->databaser->select("select * from contacts where friendLogin = '{$_SESSION['login']}'");
        foreach ($contacts as $contact) {
            $code .= "<button class='friend' value='{$contact['myId']}' onclick='getTalk(this)'>".$contact['login']."</button><br>";
        }
        $code .= "</div></div>";
        echo $code;
    }
    public function addFriend($name)
    {
        $result = $this->databaser->select("select * from usr where login = ?", [$name]);
        if (count($result) == 0) {
            echo 'Такого пользователя нет';
        } else {
            foreach ($result as $value) {
                $login = $value['login'];
                $id = $value['id'];
            }
            $already = $this->databaser->select("select friendLogin from contacts where 
            login = ? and friendLogin = ?", [$_SESSION['login'], $login]);
            if (count($already) !== 0) {
                echo 'Пользователь уже у вас в друзьях';
            } else {
                $this->databaser->insert("insert into contacts (login, friendLogin, friendId) values(?, ?, ?)", [$_SESSION['login'], $login, $id]);
                echo 'Пользователь добавлен';
            }
        }

    }
    public function getTalk($id)
    {
        $code = "<div class='chat'>";
        $result = $this->databaser->select("select * from chat where (senderId = {$_SESSION['id']} AND targetId = $id) or (senderId = $id AND targetId = {$_SESSION['id']}) order by `id` desc limit 10");
        krsort($result);
        foreach ($result as $value) {
            $code .= "<div class='message'>{$value['login']}: say to : {$value['targetId']}{$value['date']} --- {$value['message']}</div><br>";
        }
        $code .= "<div class='talker'><textarea class='field'></textarea><br><button value='$id' onclick='send(this)'>Send</button></div></div>";
        echo $code;
    }
    public function send($data)
    {
        //$data[0] - id пользователя которому отправляют сообщение, $data[1] - сообщение
        if ($data[1]) {
            $time = new \DateTime('now');
            $currentTime = $time->format('Y-m-d H:i:s');
            $result = $this->databaser->insert("insert into chat (date, login, message, targetId, senderId) values('$currentTime', '{$_SESSION['login']}', ?, '$data[0]', '{$_SESSION['id']}' )", [$data[1]]);
            echo true;
        }

    }
    public function chats()
    {
        echo 'Messages!';
    }
    public function profile()
    {
        echo 'Profile!';
    }
    public function reload($data)
    {
        $name = $data[0];
        $this->$name($data[1]);
    }
}