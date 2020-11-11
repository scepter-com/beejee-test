<?php


namespace Application\Models;

use Application\Debug;
use Application\IInitializable;

class HomeModel extends Model
{

    public function updateTask($query_members)
    {
        $id = $query_members['id'];
        $task = $query_members['task'];
        $updated_at = $query_members['updated_at'];
        $query = "UPDATE tasks SET task='$task', updated_at='$updated_at' WHERE id=$id";
        if($this->data_base->queryUpdate($query))
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function createTask($query_members)
    {
        $username = $query_members['username'];
        $email = $query_members['email'];
        $task = $query_members['task'];
        $created_at = $query_members['created_at'];
        /*$sql_query = "INSERT INTO $this->table (id, username, email, task, fulfilled_status, created_at, updated_at) VALUES (NULL, $username, $email, $task, , $created_at, NULL)";*/
        $sql_query = "INSERT INTO $this->table (id, username, email, task, fulfilled_status, created_at) VALUES (NULL, '$username', '$email', '$task', 0, '$created_at')";

        if($this->data_base->queryInsert($sql_query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateFulfilledStatus($query_members)
    {
        $id = $query_members['id'];
        (int)$fulfilled_status = $query_members['fulfilled_status'];
        $query = "UPDATE tasks SET fulfilled_status=$fulfilled_status WHERE id=$id";
        if($this->data_base->queryUpdate($query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function initialize()
    {}

}