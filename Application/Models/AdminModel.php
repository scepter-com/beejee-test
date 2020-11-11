<?php


namespace Application\Models;


class AdminModel extends Model
{

    public function login($query_members)
    {
        $username = $query_members['username'];
        $password = $query_members['password'];
        $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
        $data = $this->data_base->querySelect($sql);
        return $data;
    }

    function initialize()
    { }
}