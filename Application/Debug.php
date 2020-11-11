<?php

namespace Application;

class Debug
{
    public static function Log($msg)
    {
        file_put_contents('log.txt', $msg . "\n", FILE_APPEND);
    }
}