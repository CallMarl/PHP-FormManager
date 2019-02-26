<?php

namespace Form_Manager;

use Form_Manager\Error_Manager;
use Form_Manager\Field_Manager;

class Checker_Manager
{
    /**
    *   @var Field_Manager
    */
    private $field;

    /**
    * @var Error_Manager
    */
    private $error;

    /**
    *   @var function
    */
    private $result;

    public function __construct(Field_Manager $field, $result)
    {
        $this->field = $field;
        $this->result = $result;
    }

    public function __call($func, $arguments)
    {
        call_user_func_array($this->$callback, $arguments);
    }

    protected function get_field()
    {
        return ($this->field);
    }

    public function set_faild()
    {
        $this->error->set_faild();
    }

    public function set_error($error)
    {
        $this->error = new Error_Manager($error);
        return ($this->get_field());
    }

    public function get_error()
    {
        return ($this->error->get_error());
    }

    public function is_valid()
    {
        return ($this->$result);
    }
}
