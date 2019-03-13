<?php

namespace Form_Manager\Field;

use Form_Manager\Field_Manager;

class Option extends Field_manager
{
    /**
    *   @var Field_Manager
    */
    private $field;

    public function __construct($name, $error, $field = NULL)
    {
        parent::__construct($name, $error);
        $this->field = $field;
        $this->add_attr("value", strtolower($name));
    }

    public function selected()
    {
        if ($this->get_attr("selected") == NULL)
            $this->set_attr("selected");
        return ($this);
    }

    public function disabled()
    {
        $this->selected();
        parent::disabled();
        return ($this);
    }

    public function end_option()
    {
        return ($this->field);
    }

    public function get_html()
    {
         return ('<option ' . parent::attr_to_string() . '>' . parent::get_name() . '</option>');
    }

    public function display()
    {
        echo('<option ' . parent::attr_to_string() . '>' . parent::get_name() . '</option>');
    }
}
