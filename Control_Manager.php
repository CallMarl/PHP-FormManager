<?php

namespace Form_Manager;

class Control_Manager
{
    /**
    * @var Control_
    */
    private $control;

    public function __construct($field, $control_name, $args = [])
    {
        $control_name = ucfirst(strtolower($control_name));
        if ($this->control_exist($control_name))
        {
            $control_name = __NAMESPACE__  . "\\" . "Control" . "\\" . $control_name;
            $this->control = new $control_name($field, $args);
        }
        else
        {
            #throw new exeption "Try to add $regex_name but this regex doesent exist"
        }
    }

    private function control_exist($control_name)
    {
        $control_list = [
            "Interval",
            "Max",
            "Min"
        ];
        return (in_array($control_name, $control_list));
    }

    public function add_error($error)
    {
        $this->control->add_error($error);
    }

    public function is_valid()
    {
        return ($this->$control->is_valid());
    }
}
