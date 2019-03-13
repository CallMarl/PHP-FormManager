<?php

namespace Form_Manager\Field;

use Form_Manager\Field_Manager;

class Button extends Field_manager
{
    public function __construct($name, $error)
    {
        parent::__construct($name, $error);
        $this->set_attr("value", $name);
    }

    public function display()
    {
        echo("<button " . $this->attr_to_string() . " >" . $this->attr['value'] . "</button>");
    }
}
