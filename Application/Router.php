<?php

namespace Application;

class Router
{

    protected function __construct() { }

    public static function execute()
    {

        $request_uri = $_SERVER['REQUEST_URI'];
        $uri = trim($request_uri, '/');
        $filter = array("<", ">", ";", ":", "*", ",");
        $uri = str_replace($filter, '', $uri);
        list($main_uri, $params) = explode('@', $uri);
        !empty($params) ? $with_params = true : $with_params = false;
        $method = 'POST';
        isset($_POST) ? $method = 'POST' : $method = 'GET';

        if($with_params)
        {
            $temp_parameters = explode('&', $params);
            $parameters = array();
            foreach ($temp_parameters as $p)
            {
                $p = explode('=', $p);
                $parameters[$p[0]] = $p[1];

            }
            self::executeURI($main_uri, $parameters, $method);

        }
        else
        {
            $parameters = array();
            $parameters['GET'] = '';
            $parameters['POST'] = '';
            self::executeURI($main_uri, $parameters, $method);
        }
    }


    private static function executeURI($uri, $parameters, $method)
    {
        if($method == 'POST')
        {
            $parameters['POST'] = $_POST;
            $_POST = null;
        }
        else if($method == 'GET')
        {
            $parameters['GET'] = $_GET;
            $_GET = null;
        }

        $parameters['admin'] = Context::context()->gate->getAdmin();
        list($controller, $action) = explode('/', $uri);
        empty($controller) ? $controller = 'home' : $controller = $controller;
        empty($action) ? $action = 'index' : $action = $action;
        $class_path = 'Application\Controllers\\'.ucfirst($controller).'Controller';
        $file_path ='Application/Controllers/'.ucfirst($controller).'Controller.php';


        if(file_exists($file_path))
        {

            $class = new $class_path;
            if(method_exists($class_path, $action))
            {
                $class->$action($parameters);
            }
            else
            {
                View::error('Action not found', '404');
            }
        }
        else
        {
            View::error('Class not found', '404');;
        }
    }


}