<?php

namespace Form_Manager\Field;

use Form_Manager\Field_Manager;

class Password extends Field_Manager
{
    public function __construct($name, $error)
    {
        parent::__construct($name, $error);
    }
}
