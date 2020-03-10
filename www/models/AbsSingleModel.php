<?php


namespace App\Models;


abstract class AbsSingleModel
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

    public function getData()
    {
        return $this->data;
    }
    public function getNamedData($name = null)
    {
        return ($this->data[$name] ?? $this->data);
    }

}