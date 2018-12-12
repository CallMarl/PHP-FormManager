<?php

namespace Src\Modeles\Form_Manager;

use Src\Modeles\Form_Manager\Regex\Specific;

class Regex_Manager
{
    /**
    * @var Regex_
    */
    private $regex;

    public function __construct($field, $regex_name, $specific = FALSE)
    {
        $regex_name = ucfirst(strtolower($regex_name));
        if ($this->regex_exist($regex_name) && $specific == FALSE)
        {
            $regex_name = __NAMESPACE__  . "\\" . "Regex" . "\\" . $regex_name;
            $this->regex = new $regex_name($field);
        }
        else if ($specific == TRUE)
        {
            $this->regex = new Specific($regex);
        }
        else
        {
            #throw new exeption "Try to add $regex_name but this regex doesent exist"
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

    public function add_error($error)
    {
        $this->regex->add_error($error);
    }

    public function is_valid($to_check)
    {
        return ($this->regex->is_valide($to_check));
    }
}
