<?php

namespace Form_Manager\Field;

use Form_Manager\Field_Manager;

use Form_Manager\Field\Option;

class Select extends Field_Manager
{
    /**
    *   @var Option[]
    */
    private $option = [];

    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function add_option($value)
    {
        $this->option[] = new Option($value, $this);
        return (end($this->option));
    }

    public function get_html()
    {
        $display = "<select " . parent::attr_to_string() . ">";
        foreach ($this->option as $option)
            $display .= $option->get_html();
        return ($display .= "</select>");
    }

    public function display()
    {
        echo("<select " . parent::attr_to_string() . ">");
        foreach ($this->option as $option)
            $option->display();
        echo("</select>");
    }
}
