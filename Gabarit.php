<?php

namespace Src\Modeles\Form_Manager;

use Src\Modeles\Form_Manager\Form_manager;

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

    abstract function load_form();
}
