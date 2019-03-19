<?php

namespace Form_Manager;

use Form_Manager\Error_Manager;
use Form_Manager\Field_Manager;

class Checker_Manager
{
    /**
    *   Ensemble de fonction permettant la gestion des erreur.
    */
    use Trait_Error;

    /**
    *   @var Field_Manager
    */
    private $field;

    /**
    *   @var boolean
    */
    private $result;

    public function __construct(Field_Manager $field, $result)
    {
        $this->field = $field;
        $this->result = $result;
    }

    /**
    *   Retourne le champs associé au validateur.
    *
    *   @return Field_Manager
    */
    protected function get_field()
    {
        return ($this->field);
    }

    /**
    *   Retourn la valeur du résultat.
    *
    *   @return     boolean
    */
    public function is_valid()
    {
        return ($this->result);
    }
}
