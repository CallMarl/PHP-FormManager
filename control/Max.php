<?php

namespace Form_Manager\Control;

use Form_Manager\Control\Abstract_Control;
use Form_Manager\Field_Manager;

class Max extends Abstract_Control
{

    /**
    *   @var int
    */
    private $max;

    /**
    *   Créer une nouvelle instance de max.
    *
    *   @param Field_Manager
    *   @param array
    */
    public function __construct(Field_Manager $field, $args)
    {
        parent::__construct($field);
        if(count($args) === 2)
            $this->max = intval($args[0]);
        else
        {
            throw new \Exception("
                For a max control you must spécifies max value in args.", 1
            );
        }
    }

    /**
    *   Fonction de validation de la valeur max.
    *
    *   @return     boolean
    */
    public function is_valid()
    {
        $len = strlen($this->field->get_attr('value'));
        if($len <= $this->max)
            return (TRUE);
        return (FALSE);
    }
}

?>
