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

    public function ordGetAllArt(string $column = 'id', string $order = 'ASC', int $limitStart = null, int $limitEnd = null)
    {
        $db = new DBpdo();
        $db->setClassName(Article::class);
        if(isset($limitStart) && isset($limitEnd)){
            $sql = 'SELECT * FROM '. static::$table .' ORDER BY '. $column .' '.
                static::checkAllowed($order, static::$allowedSort). ' LIMIT '. $limitStart .','.$limitEnd;
//            var_dump($sql);die;

        }else{
            $sql = 'SELECT * FROM '. static::$table .' ORDER BY '. $column .' '.
                static::checkAllowed($order, static::$allowedSort);
        }

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

    protected static function insert(Article $obj)
    {
        $cols = array_keys($obj->getData());

        $dataIns = [];
        foreach ($cols as $val){
            $dataIns[':'. $val] = $obj->getNamedData($val);
        }

        $sql = 'INSERT INTO '.static::$table.' ('.
            implode(', ', $cols) .') VALUES ('. implode(', ', array_keys($dataIns))  .')';

        $db = new DBpdo();
        $db->exec($sql, $dataIns);
        return $db->lastInsId();
    }


    protected static function update(Article $obj)
    {
        $arr = $obj->getData();

        $dataIns =[];
        $rools =[];
        foreach ($arr as $key=>$val){
            $dataIns[':' . $key] = $val;
            $rools[$key] = $key .' = :' . $key;
        }
        $where = array_shift($rools);

        $sql = 'UPDATE '.static::$table. ' SET '. implode(', ', ($rools)) .'
            WHERE ('. $where .')';
        $db = new DBpdo();
        $db->exec($sql, $dataIns);
        return $db->lastInsId();
    }


    public static function save(Article $obj)
    {
        if(isset($obj->id)){
            return self::update($obj);
        }else{
            return self::insert($obj);
        }
    }

    public static function delete(Article $obj)
    {

        $dataIns =[];
        $rools =[];
        foreach ($obj->getData() as $key=>$val){
            $dataIns[':' . $key] = $val;
            $rools[$key] = $key .' = :' . $key;
        }

        $sql ='DELETE FROM ' . static::$table . ' WHERE '.
            implode(', ', ($rools));
        $db = new DBpdo();
        return $db->exec($sql, $dataIns);
    }



}