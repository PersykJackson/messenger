<?php

use Liloy\Application\View\View;

class ViewTest extends \PHPUnit\Framework\TestCase
{
    public $class;
    public $route;

    public function setUp(): void
    {
        $this->route = ['Controller' => 'main', 'Action' => 'index', 'Title' => 'Gfx'];
        $this->class = new Liloy\Application\View\View($this->route);
    }
    public function tearDown(): void
    {
        $this->class = null;
    }

    public function testGetView()
    {
        self::assertTrue($this->class->getView());
    }

}