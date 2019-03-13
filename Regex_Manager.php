<?php

namespace Form_Manager;

use Form_Manager\Field_Manager;
use Form_Manager\Regex\Specific;

class Regex_Manager
{
    /**
    * @var Regex_
    */
    private $regex;

    public function __construct(Field_Manager $field, $regex_name, $specific = FALSE)
    {
        $regex_name = ucfirst(strtolower($regex_name));
        if ($this->regex_exist($regex_name) && $specific == FALSE)
        {
            $regex_name = __NAMESPACE__  . "\\" . "Regex" . "\\" . $regex_name;
            $this->regex = new $regex_name($field);
        }
        else if ($specific == TRUE)
            $this->regex = new Specific($field, $specific);
        else
        {
            #throw new exeption "Try to add $regex_name but this regex type doesn't exist"
        }
    }

    private function regex_exist($regex_name)
    {
        $regex_list = [
            "Alpha",
            "Mail"
        ];
        return (in_array($regex_name, $regex_list));
    }

    public function set_error($error)
    {
        return ($this->regex->set_error($error));
    }

    public function get_error()
    {
        return ($this->regex->get_error());
    }

    public function is_valid()
    {
        return ($this->regex->is_valid());
    }
}
