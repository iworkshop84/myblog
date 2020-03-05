<?php
namespace App\Models;



use App\Classes\DBpdo;

class Articles extends AbstractModel
{

    protected $data = [];
    protected static $table = 'articles';


    public function ordGetAll(string $column = 'id', string $order = 'ASC')
    {
        $db = new DBpdo();
        $db->setClassName(Article::class);
        $sql = 'SELECT * FROM '. static::$table .' ORDER BY '. $column .' '.
            static::checkAllowed($order, static::$allowedSort);
        $res = $db->query($sql);
        $this->data = $res;
        return $this;
    }


}