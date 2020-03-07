<?php


namespace App\Classes;


class View
{
    protected $data = [];
    public $errMessage;


    public function assign(string $name, $value) : object
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
        include_once __DIR__ . '/../view/' . $template;
        $out = ob_get_contents();
        ob_end_clean();
        return $out;
    }

    public function display($template)
    {
        include_once __DIR__ . '/../view/' . $template;
    }


}