<?php


namespace Application\Authentication;


use Application\IInitializable;

class Gate implements IInitializable
{
    public $admin;

    public function __construct()
    {
        session_start();
        $this->initialize();
    }

    public function setAdmin($session_name)
    {
        $this->admin = $session_name;
        $_SESSION['admin'] = $this->admin;

    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function unsetAdmin()
    {
        $this->admin = '';
        unset($_SESSION['admin']);
    }

    function initialize()
    {
        if(isset($_SESSION['admin']))
        {
            $this->admin = $_SESSION['admin'];
        }
    }
}