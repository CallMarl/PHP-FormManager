<?php

namespace Form_Manager;

use Form_Manager\Form_Manager;

Abstract class Gabarit extends Form_manager
{
    /**
    *   @var string
    */
    private $name;

    public function __construct($name = NULL)
    {
        parent::__construct();
        $this->name = $name;
    }

    protected function get_name()
    {
        return ($this->name);
    }

    abstract function load();
}
