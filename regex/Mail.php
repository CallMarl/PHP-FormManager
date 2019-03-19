<?php

namespace Form_Manager\Regex;

use Form_Manager\Regex\Abstract_Regex;

class Mail extends Abstract_Regex
{

    /**
    *   Créer une nouvelle instance de la regex mail
    *
    *   @param Field_Manager
    */
    public function __construct($field)
    {
        parent::__construct($field);
    }

    /**
    *   Fonction de validation de la regex mail.
    *
    *   @return     boolean
    */
    public function is_valid()
    {
        if(!filter_var(
            parent::get_field()->get_attr('value'), FILTER_VALIDATE_EMAIL))
        {
            return (FALSE);
        }
        return (TRUE);
    }
}

?>
