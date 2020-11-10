<?php

use Liloy\Application\Error\ErrorWriter;

class ErrorWriterTest extends \PHPUnit\Framework\TestCase
{
    public $file;
    public $error = 'Test error';
    public function setUp(): void
    {
        file_put_contents('Report', '');

    }
    public function tearDown(): void
    {
        file_put_contents('Report', '');
    }
    public function testExecute()
    {
        ErrorWriter::execute($this->error, 'Report');
        $this->file = file_get_contents('Report');
        var_dump(preg_match("/$this->error.'fds'$/", $this->file));
        self::assertEquals(1, preg_match("/$this->error$/", $this->file));
    }
}