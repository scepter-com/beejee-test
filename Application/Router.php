<?php

namespace Application;

class Router implements IInitializable
{
    private static $instance;
    private $config;

    protected function __construct() { }

    public function initialize()
    {
        $this->config = require_once 'config.php';
    }

    public static function getRouter() : Router
    {
        if(!isset(self::$instance))
        {
            self::$instance = new static();
            self::$instance->initialize();
        }
        return self::$instance;
    }

    public static function execute()
    {
        $request_uri = $_SERVER['REQUEST_URI'];
        $uri = trim($request_uri, '/');
        $controller = 'home';
        $action = 'index';
        $params = '';
        list($main_uri, $params) = explode('?', $uri);

        !empty($params) ? $with_params = true : $with_params = false;

        echo $with_params . '<br>';
        echo $main_uri . '<br>';
        echo $params . '<br>';

        if($with_params)
        {
            $temp_parameters = explode('&', $params);
            $parameters = array();
            foreach ($temp_parameters as $p)
            {
                $p = stristr($p, '=');
                $p = trim($p, '=');
                $parameters[] = $p;
                echo $p . '<br>';
            }

            list($controller, $action) = explode('/', $uri);
            echo '<br>';
            echo '<br>';
            echo $controller . '<br>';
            echo $action . '<br>';
            $path = 'Application\Controllers\\'.ucfirst($controller).'Controller';
            if(class_exists($path))
            {
                $class = new $path;
                if(method_exists($path, $action))
                {
                    $class->$action($parameters);
                }
                else
                {
                    echo 'Method not found';
                }
            }
            else
            {
                echo '!class ex';
            }

        }
        else
        {
            echo '!withParam';
        }





        /*foreach (self::$instance->routes as $pattern => $callback)
        {

            if (preg_match($pattern, $url, $params)) // сравнение идет через регулярное выражение
            {
                // соответствие найдено, поэтому удаляем первый элемент из массива $params
                // который содержит всю найденную строку
                array_shift($params);
                return call_user_func_array($callback, array_values($params));
            }
        }*/
    }

    private function formatParameters()
    {

    }


}