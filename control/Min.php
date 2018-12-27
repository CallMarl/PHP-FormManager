<?php

namespace Form_Manager\Control;

use Form_Manager\Field_Manager;
use Form_Manager\Control\Abstract_Control;

class Min extends Abstract_Control
{

    /**
    *   @var int
    */
    private $min;

    public function __construct(Field_Manager $field, $args)
    {
        parent::__construct($field);
        if(count($args) === 1)
            $this->min = intval($args[0]);
        else
            throw new \Exception("For a min control you must spécifies min value in args.", 1);

    }

    public function is_valid()
    {
        $len = strlen($this->field->getAttr('value'));
        if($this->min <= $len)
            return TRUE;
        return FALSE;
    }
}

?>
