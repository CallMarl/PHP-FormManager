<?php

namespace Form_Manager\Control;

use Form_Manager\Field_Manager;
use Form_Manager\Control\Abstract_Control;

class Max extends Abstract_Control
{

    /**
    *   @var int
    */
    private $max;

    public function __construct(Field_Manager $field, $args)
    {
        parent::__construct($field);
        if(count($args) === 2)
            $this->max = intval($args[0]);
        else
            throw new \Exception("For a max control you must spécifies max value in args.", 1);
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
