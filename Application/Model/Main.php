<?php

namespace Liloy\Application\Model;

use Liloy\Application\Core\Model;

class Main extends Model
{
    public function getNews(): string
    {
        $result = $this->databaser->select("select * from news");
        $html = '<div class="feed">';
        foreach ($result as $value) {
            $html .= "<div class='news'><img src='{$value['src']}' alt='Изображение не загружено!'>
            <br><h2>{$value['header']}</h2><br><p>{$value['content']}<br></p></div>";
        }
        $html .= "</div>";
        return $html;
    }
}
