<?php

namespace Form_Manager\Field;

use Form_manager\Error_Manager;
use Form_Manager\Field_Manager;

class Text extends Field_manager
{
    /**
    *   Créer une nouvelle instance du champs text.
    *
    *   @param      string
    *   @param      Error_Manager
    */
    public function __construct($name, $error)
    {
        parent::__construct($name, $error);
    }
}
