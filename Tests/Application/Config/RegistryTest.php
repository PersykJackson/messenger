<?php

use Liloy\Application\Config\Registry;

class RegistryTest extends \PHPUnit\Framework\TestCase
{
    public $routes;
    public function setUp(): void
    {
        Registry::getInstance();
        $this->routes = require "Application/Config/Routes.php";
    }
    public function tearDown(): void
    {

    }
    public function testGetRoutes(): void
    {
        self::assertEquals($this->routes, Registry::getRoutes());
    }
}