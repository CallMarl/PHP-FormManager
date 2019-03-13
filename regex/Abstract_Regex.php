<?php

namespace Form_Manager\Regex;

use Form_Manager\Error_Manager;
use Form_Manager\Field_Manager;

abstract class Abstract_Regex
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

    private function new_error()
    {
        $class = new \ReflectionClass(get_class($this->field->get_error()));
        return $class->newInstanceArgs([]);
    }

    public function set_error($error)
    {
        $this->error = $this->new_error();
        $this->error->set_error($error);
        return ($this->get_field());
    }

    public function get_error()
    {
        return ($this->error);
    }

    abstract public function is_valid();
}
