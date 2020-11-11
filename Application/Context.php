<?php

namespace Application;

use Application\Authentication\Gate;

class Context implements IInitializable
{
    private static $instance;
    public Configurator $configurator;
    public Gate $gate;
    protected function __construct() { }

    public function initialize()
    {
        self::$instance->configurator = new Configurator();
        self::$instance->gate = new Gate();
    }

    public static function context() : Context
    {
        if(!isset(self::$instance))
        {
            self::$instance = new static();
            self::$instance->initialize();
        }
        return self::$instance;
    }
}