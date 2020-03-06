<?php


namespace App\Models;


class View
{
    protected $data = [];
    public $message;


    public function assign($name, object $value) : object
    {
        $this->data[$name] = $value;
        return $this;
    }


    public function getData($name = null)
    {
        return ($this->data[$name] ?? $this->data);
    }



    public function render($template)
    {
        ob_start();
        include_once __DIR__ . '/../view/'.$template;
        $out = ob_get_contents();
        ob_end_clean();
        return $out;
    }

    public function display($template)
    {
        include_once __DIR__ . '/../view/'.$template;
    }


}