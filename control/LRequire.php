<?php

namespace Form_Manager\Control;

use Form_Manager\Control\Abstract_Control;
use Form_Manager\Field_Manager;

/**
*   Le nom de la class est LRequire et non Require parce que le mot require est
*   est un terme réservé par php.
*/

class LRequire extends Abstract_Control
{
    /**
    *   Construit une nouvelle instance de require.
    *
    *   @param Field_Manager
    *   @param array
    */
    public function __construct(Field_Manager $field, $args = [])
    {
        parent::__construct($field);
        unset($args);
    }

    /**
    *   Fonction de validation de require.
    *
    *   @return     boolean
    */
    public function is_valid()
    {
        if ($this->get_field()->get_attr("value") == NULL
            || $this->get_field()->get_attr("disabled") != NULL)
            return (FALSE);
        return (TRUE);
    }
}
