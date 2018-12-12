<?php

namespace Form_Manager\Regex;

use Form_Manager\Regex\Abstract_Regex;

class Specific extends Abstract_Regex
{
    /**
    * @var string
    */
    private $regex;

    public function __construct($field, $regex)
    {
        parent::__construct($field);
        $this->regex = $regex;
    }

    public function is_valid()
    {
        if(!preg_match($this->regex, parent::get_field()->getAttr('value')))
            return FALSE;
        return TRUE;
    }
}
