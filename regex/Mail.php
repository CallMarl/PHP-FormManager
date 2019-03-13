<?php

namespace Form_Manager\Regex;

use Form_Manager\Regex\Abstract_Regex;

class Mail extends Abstract_Regex
{

    public function __construct($field)
    {
        parent::__construct($field);
    }

    public function is_valid()
    {
        if(!filter_var(parent::get_field()->get_attr('value'), FILTER_VALIDATE_EMAIL))
            return FALSE;
        return TRUE;
    }
}

?>
