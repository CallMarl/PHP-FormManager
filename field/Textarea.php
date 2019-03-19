<?php

namespace Form_Manager\Field;

use Form_manager\Error_Manager;
use Form_Manager\Field_Manager;

class Textarea extends Field_manager
{
    /**
    *   Créer une nouvelle instance du champs textarea.
    *
    *   @param      string
    *   @param      Error_Manager
    */
    public function __construct($name, $error)
    {
        parent::__construct($name, $error);
    }

    /**
    *   Redéfinition de la fonction get_html() de la class parent.
    */
    public function get_html()
    {
        return ("<textarea " . $this->attr_to_string() . " ></textarea>");
    }
}
