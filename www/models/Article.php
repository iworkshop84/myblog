<?php
namespace App\Models;


/**
 * @property integer $id;
 * @property string $title;
 * @property string $text;
 * @property integer $posttime;
 * @property integer $updtime;
 * @property integer $autor;
 */
class Article
{

    protected $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

}