<?php

namespace Form_Manager;

trait Trait_Validator
{
    /**
    * @var class
    */
    private $validator;

    /**
    *   Définit une erreur au validateur, retourne le champs associé au
    *   validateur.
    *
    *   @return Field_Manager
    */
    public function set_error($error)
    {
        return ($this->validator->set_error($error));
    }

    /**
    *   Retourn le gestionnaire d'erreur associé au validateur.
    *
    *   @return Error_Manager
    */
    public function get_error()
    {
        return ($this->validator->get_error());
    }

    /**
    *   Execute la fonction de vérification et retourne un boolean resultant de
    *   cette vérification
    *
    *   @return boolean
    */
    public function is_valid()
    {
        return ($this->validator->is_valid());
    }
}
