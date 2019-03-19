<?php

namespace Form_Manager;

class Error_Manager
{
    /**
    *   @var array
    */
    private $attr = [];

    /**
    *   @var string
    */
    private $error;

    /**
    *   @var bool
    */
    private $active;

    /**
    *   Créer une nouvelle instance du gestionnaire d'erreur, par defaut
    *   l'erreur n'est pas activé.
    *
    *   @param      string
    */
    public function __construct($error = NULL)
    {
        $this->error = $error;
        $this->active = FALSE;
    }

    /**
    *   Active l'erreur.
    */
    public function set_active()
    {
        $this->active = TRUE;
    }

    /**
    *   Retourne le status de l'erreur, si elle ect active où non.
    *
    *   @return     string
    */
    public function is_active()
    {
        return ($this->active);
    }

    /**
    *   Permet de modifier le message d'erreur associé au gestionnaire d'erreurs
    */
    public function set_error($error)
    {
        $this->error = $error;
    }

    /**
    *   Retourne le message d'erreur
    *
    *   @return     string
    */
    public function get_error()
    {
        return ($this->error);
    }

    /**
    *   Affiche le message d'erreur.
    */
     public function display()
     {
         echo ($this->get_error());
     }
}

?>
