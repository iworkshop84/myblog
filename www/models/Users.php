<?php


namespace App\Models;


use App\Classes\DBpdo;
use App\Models\User;

class Users extends AbstractModel
{
    protected $data = [];
    protected static $table = 'users';


    public function vertify(string $post, object $obj) :bool
    {
        return password_verify($_POST['password'], $obj->getData()->getData('user')['password']);
    }

    public static function genHashToken() : string
    {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }


    public function getOneByColumn($column, $value) :?object
    {
        $db = new DBpdo();
        $db->setClassName(User::class);
        $query = 'SELECT * FROM ' . static::$table . ' WHERE '.
            $column .'=:'. $column;
        $res = $db->query($query, [':' . $column=>$value]);

        if(empty($res)){
            return null;
        }
        $this->data = $res[0];
        return $this;
    }

    public function ordGetAll(string $column = 'id', string $order = 'ASC')
    {
        $db = new DBpdo();
        $db->setClassName(User::class);
        $sql = 'SELECT * FROM '. static::$table .' ORDER BY '. $column .' '.
            static::checkAllowed($order, static::$allowedSort);
        $res = $db->query($sql);
        $this->data = $res;
        return $this;
    }

    public static function update(Users $obj)
    {
        $arr = $obj->getData()->getData();

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

    public static function insert(User $obj)
    {
        $cols = array_keys($obj->getData());
        $dataIns = [];
        foreach ($cols as $val){
            $dataIns[':'. $val] = $obj->getData()[$val];
        }

        $sql = 'INSERT INTO '.static::$table.' ('.
            implode(', ', $cols) .') VALUES ('. implode(', ', array_keys($dataIns))  .')';

        $db = new DBpdo();
        $db->exec($sql, $dataIns);
        return $db->lastInsId();
    }


}