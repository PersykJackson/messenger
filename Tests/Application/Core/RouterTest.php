<?php


use Liloy\Application\Core\Router;

class RouterTest extends \PHPUnit\Framework\TestCase
{
    public $goodRouter;
    public $badRouter;
    public function setUp(): void
    {
        $this->goodRouter = new Router('/main/index');
        $this->badRouter = new Router('/main/indexx');
    }
    public function tearDown(): void
    {
        unset($this->goodRouter);
        unset($this->badRouter);
    }
    public function testRun()
    {
        self::assertTrue($this->goodRouter->run());
        self::assertFalse($this->badRouter->run());
    }
}