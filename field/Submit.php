<?php

namespace Form_Manager\Field;

use Form_manager\Error_Manager;
use Form_Manager\Field_Manager;

class Submit extends Field_manager
{
    /**
    *   @var string
    */
    public $name;

    /**
    *   Créer une nouvelle instance du champs submit.
    *
    *   @param      string
    *   @param      Error_Manager
    */
    public function __construct($name, $error)
    {
        parent::__construct($name, $error);
        $this->name = $name;
        $this->set_attr("value", $name);
    }

    /**
    *   Fonction de validation du champs submit la valeur devant etre toujours
    *   etre présent.
    */
    public function is_valid()
    {
        $is_valid = parent::is_valid();
        $this->set_attr("value", $this->name);
        return ($is_valid);
    }
}
