<?php

namespace Form_Manager\Control;

use Form_Manager\Error_Manager;
use Form_Manager\Field_Manager;

abstract class Abstract_Control
{
    /**
    *   @var Field_Manager
    */
    private $field;

    /**
    * @var Error_Manager
    */
    private $error;

    protected function __construct(Field_Manager $field)
    {
        $this->field = $field;
    }

    protected function get_field()
    {
        return ($this->field);
    }

    public function add_error($error)
    {
        $this->error = new Error_Manager($error);
        return ($this->get_field());
    }

    public function get_error()
    {
        return ($this->error->get_error());
    }

    abstract public function is_valid();
}
