<?php


namespace Application\Controllers;


use Application\Context;
use Application\Models\HomeModel;
use Application\View;
use http\Client\Response;

class HomeController extends Controller
{
    private $model;

    /**
     * HomeController constructor.
     * @param $model
     */
    public function __construct()
    {
        $this->model = new HomeModel('tasks');
    }


    public function index($data)
    {

        $data['page'] = self::getCurrentPage($data);
        $sort_by = $data['sortby'];
        $order_type = $data['ordertype'];
        mb_strtoupper($order_type);
        if(isset($data['page'])){
            $current_page = $data['page'];
        } else {
            $current_page = 1;
        }
        $limit_pagination = 3;
        $paginator_container = $this->model->paginate($current_page, $limit_pagination, $sort_by, $order_type);
        $data['rows'] = $paginator_container->getRows();
        $records_amount = $paginator_container->getRecordsAmount();
        $records_amount == 0 ? $records_amount = 1 : $records_amount = $records_amount;
        $data['records_amount'] = $records_amount;
        $data['pages'] = ceil($records_amount/$limit_pagination);
        if($current_page > ceil($records_amount/$limit_pagination))
        {
            View::error('Page not found', '404');
        }
        else
        {
            View::render('Home', $data, 'home');
        }

    }

    public function create($data)
    {
        $post_data = $data['POST'];

        $username = $post_data['username'];
        $email = $post_data['email'];
        $task = $post_data['task'];
        $created_at = date("F j, Y, g:i a");
        $members = array("username", "email", "task");
        $query_members = compact("created_at", $members);



        if($this->model->createTask($query_members))
        {
            echo "Запись создана.";
        }
        else
        {
            echo "Ну удалось создать запись.";
        }
    }

    public function update($data)
    {
        if(isset($data['admin']))
        {
            $post_data = $data['POST'];
            if(isset($post_data['task']))
            {
                $query_members['id'] = $post_data['task_id'];
                $query_members['task'] = $post_data['task'];
                $query_members['updated_at'] = date("F j, Y, g:i a");
                if($this->model->updateTask($query_members))
                {
                    echo 'Задание обновлено.';
                }
                else
                {
                    echo 'Ошибка';
                }
            }
            elseif (isset($post_data['fulfilled_status']))
            {
                $query_members['id'] = $post_data['task_id'];
                $query_members['fulfilled_status'] = $post_data['fulfilled_status'];
                if($this->model->updateFulfilledStatus($query_members))
                {
                    echo 'Задание отмечено.';
                }
                else
                {
                    echo 'Ошибка';
                }
            }
            else
            {
                echo '+++';
            }
        }
        else
        {
            echo 'auth_error';
        }
    }


    private static function getCurrentPage($data)
    {
        if(isset($data['page']))
        {
            $current_page = $data['page'];
        }
        else
        {
            $current_page = 1;
        }
        return $current_page;
    }

}