<?php

namespace Form_Manager\Field;

use Form_Manager\Field_Manager;
use Form_manager\Error_Manager;
use Form_Manager\Field\Option;

class Select extends Field_Manager
{
    /**
    *   @var string []
    */
    private $option = [];

    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function __get($name)
    {
        if (in_array($name, $this->option))
            return ($this->$name);
    }

    public function add_option($option)
    {
        $option = strtolower($option);
        $this->$option = new Option($option, $this);
        $this->option[] = $option;
        return ($this->$option);
    }

    public function set_error($error)
    {
        $this->error = new Error_Manager($error);
        return ($this);
    }

    public function is_valid()
    {
        $no_error = TRUE;
        $option = $this->get_attr("value");
        if ($option != NULL && !isset($this->$option))
        {
            $this->error->set_faild();
            return (FALSE);
        }
        if ($option != NULL && $this->$option->is_disabled())
        {
            $this->disabled();
            $no_error = parent::is_valid();
            $this->unset_attr("disabled");
        }
        else
            $no_error = parent::is_valid();
        if ($option != NULL && $no_error == TRUE && $this->is_persist() == TRUE)
            $this->$option->selected();
        return ($no_error);
    }

    public function get_html()
    {
        $display = "<select " . parent::attr_to_string() . ">";
        foreach ($this->option as $option)
            $display .= $this->$option->get_html();
        return ($display .= "</select>");
    }

    public function display()
    {
        echo("<select " . parent::attr_to_string() . ">");
        foreach ($this->option as $option)
            $this->$option->display();
        echo("</select>");
    }
}
