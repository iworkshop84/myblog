<?php
namespace App\Models;



use App\Classes\DBpdo;

class Articles extends AbstractModel
{

//    protected $data = [];
    protected static $table = 'articles';

    public static function simpleGetAll()
    {
        $db = new DBpdo();
        $db->setClassName(Article::class);
        return $db->query('SELECT * FROM '. static::$table);
    }
}