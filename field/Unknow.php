<?php

namespace Form_Manager\Field;

use Form_Manager\Field_Manager;

class Unknow extends Field_manager
{
    public function __construct($name, $error, $type)
    {
        parent::__construct($name, $error);
        $this->type = $type;
        $this->set_attr("type", $this->type);
    }

    public function set_attr($html_attr, $value = NULL)
    {
        if (!strcmp($html_attr, "name"))
        {
            throw new \Exception("You are not allow to change the
                                  field name from use the form_manger
                                  to set the name", 1);
        }
        if(gettype($html_attr) === "string")
        {
            $this->attr[$html_attr] = $value;
        }
        return ($this);
    }
}
