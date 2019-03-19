<?php

namespace Form_Manager\Field;

use Form_Manager\Error_Manager;
use Form_Manager\Field_Manager;

class Option extends Field_manager
{
    /**
    *   @var Field_Manager
    */
    private $field;

    /**
    *   Créer une nouvelle instance du champs option. Le champs field précise
    *   si ces option sont associé à un autre champs.
    *
    *   @param      string
    *   @param      Error_Manager
    */
    public function __construct($name, $error, $field = NULL)
    {
        parent::__construct($name, $error);
        $this->field = $field;
        $this->add_attr("value", strtolower($name));
    }

    /**
    *   Fonction permettant d'indiqué le champs selectionner.
    */
    public function selected()
    {
        if ($this->get_attr("selected") == NULL)
            $this->set_attr("selected");
        return ($this);
    }

    /**
    *   Fonction permettant de selectionner un champs par defaut parmis les
    *   option et d'empecher de retourner dessus.
    *
    *   @return Field_Manager
    */
    public function disabled()
    {
        $this->selected();
        parent::set_attr("disable", "true");
        return ($this);
    }

    /**
    *   Retourne l'instance du champs associé si un champs est associé sinon
    *   retourn null
    *
    *   @return Field_Manager
    */
    public function end_option()
    {
        if ($this->field != NULL)
            return ($this->field);
        return (NULL);
    }

    /**
    *   Redéfinition de la fonction get_html() de la class parent.
    */
    public function get_html()
    {
         return (
             '<option ' . parent::attr_to_string() . '>' . parent::get_name() .
             '</option>'
         );
    }
}
