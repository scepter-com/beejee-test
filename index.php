<?php

use Application\Context;
use Application\Router;

spl_autoload_register(function($class)
{
    $path = '';
    $absolutePath = explode("\\", $class);
    foreach ($absolutePath as $item)
    {
        $path .= "/" . $item;
    }
    $path .= ".php";
    $path = substr($path, 1);

    try
    {
        require_once $path;
    }
    catch (Exception $e)
    {
        throw new Exception("Невозможно загрузить $class.  " . $e);
    }
});

$context = Context::context();
Router::execute();





