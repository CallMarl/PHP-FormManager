<?php

namespace Form_Manager\Regex;

class Alpha extends Abstract_Regex
{

    /**
    *   Créer une nouvelle instance de la regex alpha
    *
    *   @param Field_Manager
    */
    public function __construct(Field_Manager $field)
    {
        parent::__construct($field);
    }

    /**
    *   Fonction de validation de la regex alpha.
    *
    *   @return     boolean
    */
    public function is_valid()
    {
        if(!preg_match('/[^[:alpha:]\s-]/i',
            parent::get_field()->get_attr('value')))
        {
            return (FALSE);
        }
        return (TRUE);
    }
}
