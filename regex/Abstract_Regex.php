<?php

namespace Form_Manager\Control;

use Form_Manager\Field_Manager;
use Form_Manager\Trait_Error;

abstract class Abstract_Regex
{
    /**
    *   Ensemble de fonction permettant la gestion des erreur.
    */
    use Trait_Error;

    /**
    *   @var Field_Manager
    */
    private $field;

    protected function __construct(Field_Manager $field)
    {
        $this->field = $field;
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

    abstract public function is_valid();
}
