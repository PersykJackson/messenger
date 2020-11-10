<?php


namespace Liloy\Application\Error;


class ErrorWriter
{
    protected static $file;
    protected static $time;
    protected static $path;
    private static function prepare($path): void
    {
        self::$file = file_get_contents($path);
        $time = new \DateTime('now');
        self::$time = $time->format('Y-m-d H:i:s');
    }
    public static function execute(string $info, string $path = '../Application/Error/Reports/Report'): void
    {
        self::prepare($path);
        if(self::$file !== ''){
            self::$file .= "\n";
        }
        self::$file .= self::$time." - $info";
        file_put_contents($path, self::$file);
    }
}