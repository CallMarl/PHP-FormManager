<?php

namespace Src\Modeles\Form_Manager\Control;

use Src\Modeles\Form_Manager\Field_Manager;
use Src\Modeles\Form_Manager\Control\Abstract_Control;

class Min extends Abstract_Control
{

    /**
    *   @var int
    */
    private $min;

    public function __construct(Field_Manager $field, $args){
        parent::__construct($field);
        if(count($args) === 2)
            $this->min = intval($args[0]);
        else
        {
            #throw exception Interval class word with: one min value.
        }
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
