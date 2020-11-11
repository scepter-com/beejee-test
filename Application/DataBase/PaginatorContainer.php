<?php


namespace Application\DataBase;

class PaginatorContainer
{
    private $rows;
    private $current_page;
    private $records_amount;
    private $limit;

    /**
     * @return mixed
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @return mixed
     */
    public function getCurrentPage()
    {
        return $this->current_page;
    }

    /**
     * @return mixed
     */
    public function getRecordsAmount()
    {
        return $this->records_amount;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }


    /**
     * PaginatorContainer constructor.
     * @param $rows
     * @param $current_page
     * @param $length
     * @param $limit
     */
    public function __construct($rows, $current_page, $length, $limit)
    {
        $this->rows = $rows;
        $this->current_page = $current_page;
        $this->records_amount = $length;
        $this->limit = $limit;
    }


}