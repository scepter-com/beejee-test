<?php

namespace Application;

class Configurator
{
    public $config;
    public $db_config;
    public function __construct()
    {
        $this->config = require 'Application/config.php';
        $this->db_config = require 'Application/DataBase/db_config.php';
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getDbConfig()
    {
        return $this->db_config;
    }
}