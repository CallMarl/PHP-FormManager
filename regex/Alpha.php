<?php

namespace Form_Manager\Regex;

class Alpha extends Abstract_Regex
{

    public function __construct($field)
    {
        parent::__construct($field);
    }

    public function is_valid()
    {
        if(!preg_match('/[^[:alpha:]\s-]/i',
                        parent::get_field()->getAttr('value'))
          )
        {
            return FALSE;
        }
        return TRUE;
    }
}
