<?php

namespace Form_Manager;

use Form_Manager\Caller_Checker;
use Form_Manager\Caller_Control;
use Form_Manager\Caller_Regex;
use Form_Manager\Error_Manager;
use Form_Manager\Trait_Error;
use Form_Manager\Trait_Manager;

abstract class Field_Manager
{
    /**
    *   Ensemble de fonctions utile et concordante entre les différents Manager.
    */
    use Trait_Manager;

    /**
    *   Ensemble de fonction permettant la gestion des erreur.
    */
    use Trait_Error;

    /**
    *   @var string
    */
    private $name;

    /**
    *   @var array
    */
    protected $attr = [];

    /**
    *   @var bool
    */
    private $persist;

    /**
    *   @var Caller_Regex[]
    *   @var Caller_Control[]
    */
    private $checker = [];

    /**
    *   @var string
    */
    private $type;


    /**
    *   Fonction d'initialisation par défaut d'un champs de formulaire.
    *   Un champs de formulaire à par défaut un nom et un type de définit, il
    *   est mis en mode persistant.
    *
    *   @param      string $name
    *   @param      Error_Manager $error
    */
    public function __construct($name, $error)
    {
        $class_name = explode("\\", get_class($this));

        $this->name = $name;
        $this->error = $error;
        $this->type = strtolower(end($class_name));
        $this->add_attr("name", $this->name);
        $this->add_attr("type", $this->type);
        $this->set_persist();
    }

    /**
    *   Retourne le nom du champs.
    *
    *   @return     string
    */
    public function get_name()
    {
        return ($this->name);
    }

    /**
    *   Retourne le type du champs sous forme d'une chaine de caractère.
    *
    *   @return     string
    */
    public function get_type()
    {
        return ($this->type);
    }

    /**
    *   Modifie la valeur du booléan persist.
    *
    *   @return     Field_Manager
    */
    public function set_persist()
    {
        if ($this->persist == TRUE)
            $this->persist = FALSE;
        else
            $this->persist = TRUE;
        return ($this);
    }

    /**
    *   Accesseur retournant la valeur associé a la variable persist.
    *
    *   @return     boolean
    */
    public function is_persist()
    {
        return ($this->persist);
    }

    /**
    *   Permet d'ajouter un nouvelle attribut au champs de formulaire, tout les
    *   les attributs doivent etre unique, une exception est levée dans le cas
    *   contraire.
    *
    *   @param      string $html_attr
    *   @param      string $value
    *   @return     Field_Manager
    */
    private function add_attr($html_attr, $value = NULL)
    {
        if (array_key_exists($html_attr, $this->attr))
        {
            throw new \Exception("
                The attribut " . $html_attr . " is already added use set_attr()
                function to update it", 1
            );
        }
        if(gettype($html_attr) === "string")
            $this->attr[$html_attr] = $value;
        return ($this);
    }

    /**
    *   Permet de modifier où d'ajouter un attribut au champs. Les attribut
    *   type et name ne peuvent pas etre reédité des exception sont levées dans
    *   le cas contraire.
    *
    *   @param      string $html_attr
    *   @param      string $value
    *   @return     Field_Manager
    */
    public function set_attr($html_attr, $value = NULL)
    {
        if (!strcmp($html_attr, "name"))
        {
            throw new \Exception("
                You are not allow to change the field name from this way use
                the form manager to set the name", 1
            );
        }
        if (!strcmp($html_attr, "type"))
        {
            throw new \Exception("
                You are not allow to setup the field type from fixed type use
                the unknow type to setup yours", 1
            );
        }
        return ($this->add_attr($html_attr, $value));
    }

    /**
    *   Retourn la valeur d'un attribut
    *
    *   @return     string
    */
    public function get_attr($html_attr)
    {
        if (isset($this->attr[$html_attr]))
            return ($this->attr[$html_attr]);
        return (NULL);
    }

    /**
    *   Supprime la valeur d'un attribut. Les attribut type et name ne peuvent
    *   pas etre supprimé une exception est levé si l'on tente de les supprimer
    */
    public function unset_attr($html_attr)
    {
        if (!strcmp($html_attr, "name"))
        {
            throw new \Exception("
                You are not allow to unset the field name", 1
            );
        }
        if (!strcmp($html_attr, "type"))
        {
            throw new \Exception("
                You are not allow to unset the field type", 1
            );
        }
        if (isset($this->attr[$html_attr]))
            unset($this->attr[$html_attr]);
    }

    /**
    *   Vérifie l'existance d'un attribut meme si aucune valeur ne lui est
    *   est associé.
    *
    *   @return boolean
    */
    public function isset_attr($html_attr)
    {
        if (isset($this->attr[$html_attr]))
            return (TRUE);
        return (FALSE);
    }

    /**
    *   Associe au champs un validateur basé sur une regex.
    *
    *   @param      string
    *   @param      boolean
    *   @return     Caller_Regex
    */
    public function add_regex($regex, $specific = FALSE)
    {
        $regex = new Caller_Regex($this, $regex, $specific);
        $this->checker[] = $regex;
        return (end($this->checker));
    }

    /**
    *   Associe au champs un validateur basé sur un control.
    *
    *   @param      string
    *   @param      array
    *   @return     Caller_Control
    */
    public function add_control($control, $args = [])
    {
        $control = new Caller_Control($this, $control, $args);
        $this->checker[] = $control;
        return (end($this->checker));
    }

    /**
    *   Associe au champs un validateur basé sur le résultat d'une fonction
    *   personnalisé.
    *
    *   @param      boolean
    *   @return     Caller_Checker
    */
    public function add_checker(boolean $checker)
    {
        $checker = new Caller_Checker($this, $checker);
        $this->checker[] = $checker;
        return (end($this->checker));
    }

    /**
    *   Fonction de vérification du champs. Les valideuts associé au champs sont
    *   executé
    *
    *   @return     boolean
    */
    public function is_valid()
    {
        $is_valid = TRUE;
        foreach ($this->checker as $value)
        {
            if (!($is_valid = $value->is_valid()))
            {
                $this->error = $value->get_error();
                break ;
            }
        }
        if ($is_valid == FALSE)
                $this->error->set_active();
        if ($is_valid == FALSE || $this->persist == FALSE)
            $this->unset_attr("value");
        return ($no_error);
    }

    /**
    *   Retourne le champs avec ses attributs au format HTML dans une chaine de
    *   caractère.
    *
    *   @return     string
    */
    public function get_html()
    {
        return ("<input " . $this->attr_to_string() . " />");
    }

    /**
    *   Affiche le champs avec ses attributs au format HTML
    */
    public function display()
    {
        echo($this->get_html());
    }
}
