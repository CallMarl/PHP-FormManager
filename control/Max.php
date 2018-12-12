<?php

namespace Src\Modeles\Form_Manager\Control;

use Src\Modeles\Form_Manager\Field_Manager;
use Src\Modeles\Form_Manager\Control\Abstract_Control;

class Max extends Abstract_Control
{

    /**
    *   @var int
    */
    private $max;

    public function __construct(Field_Manager $field, $args){
        parent::__construct($field);
        if(count($args) === 2)
            $this->max = intval($args[0]);
        else
        {
            #throw exception Interval class word with:  one max value.
        }
    }

    public function is_valid()
    {
        $len = strlen($this->field->getAttr('value'));
        if($len <= $this->max)
            return TRUE;
        return FALSE;
    }
}

?>
