<?php

namespace Form_Manager\Field;

use Form_Manager\Field_Manager;

class Submit extends Field_manager
{
    /**
    *   @var string
    */
    public $name;

    public function __construct($name, $error)
    {
        parent::__construct($name, $error);
        $this->name = $name;
        $this->set_attr("value", $name);
    }

    public function is_valid()
    {
        $is_valid = parent::is_valid();
        $this->set_attr("value", $this->name);
        return ($is_valid);
    }
}
