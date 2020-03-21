<?php


namespace App\Classes;


class Paginathion
{
    public $perPage;
    public $count;
    public $numPages;

    public function __construct($perPage = 10)
    {
        $this->perPage = $perPage;
    }

    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    public function setNumPage()
    {
        $this->numPages = ceil($this->count / $this->perPage);
        return $this;
    }





}