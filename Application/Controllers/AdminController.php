<?php


namespace Application\Controllers;


use Application\Context;
use Application\Debug;
use Application\Models\AdminModel;
use Application\View;
use Application\Authentication\Gate;

class AdminController extends Controller
{
    private $model;
    private $config;
    public function __construct()
    {
        $this->model = new AdminModel('admins');
        $this->config = Context::context()->configurator->getConfig();
    }


    public function index($data)
    {
        $data['admin'] = Context::context()->gate->getAdmin();
        View::render('Login', $data, 'login');
    }

    public function logout()
    {
        Context::context()->gate->unsetAdmin();
        header('Location: ' . $this->config['domain_name'] . 'home');
    }
    public function login($data)
    {

        $post_data = $data['POST'];
        $username = $post_data['username'];
        $password = $post_data['password'];
        $query_members['username'] = $username;
        $query_members['password'] = $password;
        $sql_result = $this->model->login($query_members);

        if(isset($sql_result[0]['password']))
        {
            if($sql_result[0]['password'] == $password)
            {
                Context::context()->gate->setAdmin($sql_result[0]['username']);
                echo 'Log in successful';
            }
            else
            {
                echo 'Wrong password';
            }
        }
        else
        {
            echo 'Log in failed';
        }
    }
}