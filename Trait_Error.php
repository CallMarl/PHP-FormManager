<?php

namespace Form_Manager;

use Form_Manager\Error_Manager;

trait Trait_Error
{
    /**
    *   @var Error_Manager
    */
    protected $error;

    /**
    *   Fonction permettant de gérer la reflection de class de façon dynamique
    *   Le type de class d'erreur correspond à celle indiqué dans le gabarit.
    *   Tout les champs associé au formulaire prendrons le gestionnaire d'erreur
    *   instancié dans les gabarit.
    *
    *   @return class
    */
    private function new_error()
    {
        $class = new \ReflectionClass(get_class($this->error));
        return $class->newInstanceArgs([]);
    }

    /**
    *   Fonction retournant l'objet de type erreur.
    */
    public function get_error()
    {
        return ($this->error);
    }

    /**
    *   Modifie le message d'erreur du formulaire, ce message d'erreur est
    *   utile seulement si le mode hard est activé.
    *
    *   @return class
    */
    public function set_error($error)
    {
        $this->error = $this->new_error();
        $this->error->set_error($error);
        return ($this);
    }

    /**
    *   Supprime le message d'erreur.
    *
    *   @return class
    */
    public function unset_error()
    {
        unset($this->error);
        return ($this);
    }

    /**
    *   Affiche les message d'erreur.
    */
    public function display_error()
    {
        $this->error->display();
    }
}
