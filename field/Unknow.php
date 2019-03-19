<?php

namespace Form_Manager\Field;

use Form_manager\Error_Manager;
use Form_Manager\Field_Manager;

class Unknow extends Field_manager
{
    /**
    *   Créer une nouvelle instance d'un champs d'un type personnalisé.
    *
    *   @param      string
    *   @param      Error_Manager
    *   @param      string
    */
    public function __construct($name, $error, $type)
    {
        parent::__construct($name, $error);
        $this->type = $type;
        $this->set_attr("type", $this->type);
    }

    /**
    *   Redefinition de la fonction set_attr de la classe parent afin de lever
    *   l'exception sur celle-ci.
    *
    *   @param      string
    *   @param      string
    *   @return     Unknow
    */
    public function set_attr($html_attr, $value = NULL)
    {
        if (!strcmp($html_attr, "name"))
        {
            throw new \Exception("You are not allow to change the
                                  field name from use the form_manger
                                  to set the name", 1);
        }
        if(gettype($html_attr) === "string")
        {
            $this->attr[$html_attr] = $value;
        }
        return ($this);
    }
}
