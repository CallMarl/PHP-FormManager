<?php

namespace Form_Manager;

use Form_Manager\Field_Manager;

class Control_Manager
{
    /**
    * @var Control_
    */
    private $control;

    public function __construct(Field_Manager $field, $control_name, $args = [])
    {
        $control_name = ucfirst(strtolower($control_name));
        if ($this->control_exist($control_name))
        {
            if (!strcmp($control_name, "Require"))
                $control_name = "LRequire";
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
            "Min",
            "Require"
        ];
        return (in_array($control_name, $control_list));
    }

    public function set_error($error)
    {
        return ($this->control->set_error($error));
    }

    public function get_error()
    {
        return ($this->control->get_error());
    }

    public function is_valid()
    {
        return ($this->control->is_valid());
    }
}
