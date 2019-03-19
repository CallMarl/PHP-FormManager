<?php

namespace Form_Manager\Field;

use Form_Manager\Error_Manager;
use Form_Manager\Field_Manager;

class Password extends Field_Manager
{
    /**
    *   Créer une nouvelle instance du champs password.
    *
    *   @param      string
    *   @param      Error_Manager
    */
    public function __construct($name, $error)
    {
        parent::__construct($name, $error);
    }
}
