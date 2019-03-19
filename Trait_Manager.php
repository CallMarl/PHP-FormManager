<?php

namespace Form_Manager;

trait Trait_Manager
{
    /**
    *   @var array
    */
    private $css = [];

    /**
    *   Fonction d'extension améliorant la gestion des class CSS dans les champs
    *   de formulaire
    *
    *   @return class
    */
    public function add_class($css_class)
    {
        if(gettype($css_class) === "string")
        {
            $this->css[] = $css_class;
        }
        return ($this);
    }

    /**
    *   Fonction ajoutant les class css dans une seul chaine de caractère dans
    *   les attribut.
    */
    private function generate_class_attr()
    {
        if ($this->css != NULL)
        {
            $css_string = implode(" ", $this->css);
            $this->attr["class"] .= $css_string;
        }
    }

    /**
    *   Fonction qui retourne l'ensemble des attribut formaté dans une chaine de
    *   caractère.
    */
    protected function attr_to_string()
    {
        $this->generate_class_attr();
        foreach ($this->attr as $key => $value)
        {
            $string_attr = "";
            $string_attr .= $key;
            if ($value != NULL)
                $string_attr .= " = " . "\"" . $value . "\"";
            $attr[] = $string_attr;
         }
         return (implode(" ", $attr));
    }
}
