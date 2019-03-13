<?php

namespace Form_Manager\Field;

use Form_Manager\Field_Manager;

class Textarea extends Field_manager
{
    public function __construct($name, $error)
    {
        parent::__construct($name, $error);
    }

    public function display()
    {
        echo("<textarea " . $this->attr_to_string() . " ></textarea>");
    }
}
