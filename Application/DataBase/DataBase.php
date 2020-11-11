<?php


namespace Application\DataBase;

use Application\Configurator;
use Application\Context;
use PDO;

class DataBase
{
    private $pdo;

    /**
     * @return mixed
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * DataBase constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $conf = Context::context()->configurator->getDbConfig();

        $host = $conf['host'];
        $db = $conf['db'];
        $user = $conf['user'];
        $password = $conf['password'];
        $charset = $conf['charset'];

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try
        {
            $this->pdo = new PDO($dsn, $user, $password, $opt);
        }
        catch (PDOException $e)
        {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }

    public function querySelect($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result_data = $stmt->fetchAll();
        return $result_data;
    }

    public function queryInsert($sql)
    {

        $stmt = $this->pdo->prepare($sql);
        try
        {
            $stmt->execute();
            return true;
        }
        catch (\PDOException $e)
        {
            return false;
        }

    }

    public function recordsAmount($table)
    {
        $query = "SELECT COUNT(*) FROM $table";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0]['COUNT(*)'];
    }

    public function queryUpdate($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        try
        {
            $stmt->execute();
            return true;
        }
        catch (\PDOException $e)
        {
            return false;
        }
    }
    public function paginateEntities($table, $current_page, $limit, $sort_by, $order_type)
    {
        $records_amount = $this->recordsAmount($table);
        $start_record =  ($current_page * $limit) - $limit;
        $length = ceil($records_amount/$limit);
        $query = "SELECT * FROM $table";
        if(!empty($sort_by))
        {
            $query .= " ORDER BY $sort_by ";
        }
        if(!empty($order_type))
        {
            $query .= $order_type;
        }
        $query .= " LIMIT $start_record, $limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result_data = $stmt->fetchAll();
        $paginator_container = new PaginatorContainer($result_data, $current_page, $records_amount, $limit);
        return $paginator_container;

    }

}