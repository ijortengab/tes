<?php

namespace PedagangAmanah;

class Log
{
    protected static $fileName = 'log.txt';

    /**
     *
     */
    public static function write($string, $fileName = null)
    {
        if (null === $fileName) {
            $fileName = self::$fileName;
        }
        $string = (string) trim($string) . PHP_EOL;
        $string = date("c") . ' ' . $string;
        file_put_contents($fileName, $string, FILE_APPEND);
    }
}
