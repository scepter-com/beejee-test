<?php


namespace Application\Models;

use Application\DataBase\DataBase;
use Application\IInitializable;

abstract class Model implements IInitializable
{
    protected $data_base;
    protected $table;


    public function getTable()
    {
        return $this->table;
    }

    public function setTable($table): void
    {
        $this->table = $table;
    }

    public function __construct($table_name)
    {
        $this->data_base = new DataBase();
        $this->table = $table_name;
    }

    public function paginate($current_page, $limit, $sort_by, $order_type)
    {
        $paginator_container = $this->data_base->paginateEntities($this->table, $current_page, $limit, $sort_by, $order_type);
        return $paginator_container;
    }


}