<?php

namespace App\Models;

use App\Classes\DBpdo;
use App\Classes\BaseException;


abstract class AbstractModel
{
    protected static $allowedSort = ['ASC', 'DESC'];
    protected $data = [];


    protected static function checkAllowed($data, $allowedArr)
    {
        if(in_array($data, $allowedArr))
        {
            return $data;
        }
        return false;
    }

    public function getData()
    {
        return $this->data;
    }


    public static function simpleGetAll()
    {
        $db = new DBpdo();
        $db->setClassName(Article::class);
        return $db->query('SELECT * FROM '.static::$table);
    }


    public static function orderGetAll(string $column = 'id', string $order = 'ASC')
    {
        $db = new DBpdo();
        $db->setClassName(get_called_class());
        $sql = 'SELECT * FROM '. static::$table .' ORDER BY '. $column .' '.
            static::checkAllowed($order, static::$allowedSort);
        $res = $db->query($sql);
        return $res;
    }


}