<?php


namespace Liloy\Application\Core;

use Liloy\Application\Config\Databaser;

class Model
{
    public $databaser;
    public function __construct()
    {
        $this->databaser = new Databaser();
    }
}
