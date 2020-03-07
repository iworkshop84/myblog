<?php
namespace App\Models;



use App\Classes\DBpdo;
use App\Classes\BaseException;

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

    public function getOneByColumn($column, $value) :?object
    {
        $db = new DBpdo();
        $db->setClassName(Article::class);
        $query = 'SELECT * FROM ' . static::$table . ' WHERE '.
            $column .'=:'. $column;
        $res = $db->query($query, [':' . $column=>$value]);

        if(empty($res)){
            return null;
        }
        $this->data = $res[0];
        return $this;
    }


    public function getOneById(int $id) :?object
    {
        $db = new DBpdo();
        $db->setClassName(Article::class);
        $query = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';
        $res = $db->query($query, [':id'=>$id]);

        if(empty($res)){
            return null;
        }
        return $res[0];
    }

    public static function insert(Article $obgArt)
    {
        $cols = array_keys($obgArt->getData());

        $dataIns = [];
        foreach ($cols as $val){
            $dataIns[':'. $val] = $obgArt->getNamedData($val);
        }

        $sql = 'INSERT INTO '.static::$table.' ('.
            implode(', ', $cols) .') VALUES ('. implode(', ', array_keys($dataIns))  .')';

        $db = new DBpdo();
        $db->exec($sql, $dataIns);
        return $db->lastInsId();
    }

}