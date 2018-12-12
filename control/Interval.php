<?php

namespace Form_Manager\Control;

use Form_Manager\Field_Manager;
use Form_Manager\Control\Abstract_Control;

class Interval extends Abstract_Control
{
    /**
    *   @var int
    */
    private $min;

    /**
    *   @var int
    */
    private $max;

    public function __construct(Field_Manager $field, $args){
        parent::__construct($field);
        if(count($args) === 2)
        {
            $this->min = intval($args[0]);
            $this->max = intval($args[1]);
        }
        else
        {
            #throw exception Interval class word with: one min value, one max value.
        }
    }

    public function is_valid()
    {
        $len = strlen(parent::get_field()->getAttr('value'));
        if($this->min <= $len && $len <= $this->max)
            return TRUE;
        return FALSE;
    }
}

?>
