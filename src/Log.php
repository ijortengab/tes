<?php
    
namespace PedagangAmanah;

class Log
{
    protected static $fileName = 'log.txt';

    /**
     *
     */
    public static function write($string)
    {
        $string = (string) trim($string) . PHP_EOL;
        $string = date("c") . ' ' . $string;
        file_put_contents(self::$fileName, $string, FILE_APPEND);
    }
}
