<?php

namespace Form_Manager\Control;

use Form_Manager\Field_Manager;
use Form_Manager\Control\Abstract_Control;

/**
*   Change the class name of Require to Lrequire, because require is an php
*   reserved word.
*/

class LRequire extends Abstract_Control
{
    public function __construct(Field_Manager $field, $args)
    {
        parent::__construct($field);
    }

    public function is_valid()
    {
        if ($this->get_field()->get_attr("value") == NULL
        || $this->get_field()->get_attr("disabled") != NULL)
            return (FALSE);
        return (TRUE);
    }
}
