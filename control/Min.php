<?php

namespace Form_Manager\Control;

use Form_Manager\Control\Abstract_Control;
use Form_Manager\Field_Manager;

class Min extends Abstract_Control
{

    /**
    *   @var int
    */
    private $min;

    /**
    *   Créer une nouvelle instance de min.
    *
    *   @param Field_Manager
    *   @param array
    */
    public function __construct(Field_Manager $field, $args)
    {
        parent::__construct($field);
        if(count($args) === 1)
            $this->min = intval($args[0]);
        else
        {
            throw new \Exception("
                For a min control you must spécifies min value in args.", 1
            );
        }
    }

    /**
    *   Fonction de validation de la valeur min.
    *
    *   @return     boolean
    */
    public function is_valid()
    {
        $len = strlen($this->field->get_attr('value'));
        if($this->min <= $len)
            return (TRUE);
        return (FALSE);
    }
}

?>
