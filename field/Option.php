<?php

namespace Src\Modeles\Form_Manager\Field;

use Src\Modeles\Form_Manager\Field_Manager;

class Option extends Field_manager
{
    /**
    *   @var Field_Manager
    */
    private $field;

    public function __construct($name, $field = NULL)
    {
        parent::__construct($name);
        $this->add_attr("value", strtolower($name));
        $this->field = $field;
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
