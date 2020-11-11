<?php


namespace Application;


class View
{
    public static function render($title, $data, $view)
    {
        $config = Context::context()->configurator->getConfig();
        $viewPath = $config['views'] . $view . '.php';
        $layout = $config['app_layout'];

        extract($title);
        extract($data);
        if(file_exists($viewPath))
        {
            ob_start();
            require $viewPath;
            $content = ob_get_clean();
            require $layout;
        }
        else
        {
            self::error('View not found', 404);
        }
    }

    public static function error($title, $error_code)
    {
        $config = Context::context()->configurator->getConfig();
        $viewPath = $config['views'] . 'error.php';
        $layout = $config['app_layout'];

        extract($title);
        extract($error_code);
        if(file_exists($viewPath))
        {
            ob_start();
            require $viewPath;
            $content = ob_get_clean();
            include($layout);
        }
    }
}