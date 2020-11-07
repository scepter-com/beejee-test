<?php

use Application\Router;
require_once 'Resources/layouts/default_layout.php';
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
        throw new Exception("Невозможно загрузить $class.");
    }

});

$router = Router::getRouter();
Router::execute();


/*
list($folder, $controller, $action) = preg_split('/', $request_uri);

*/



