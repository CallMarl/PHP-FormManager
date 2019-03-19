<?php

namespace Form_Manager;

use Form_Manager\Field_Manager;

class Control_Manager
{
    /**
    *   Ensemble de fonction permettant la gestion des validateurs.
    */
    use Trait_Validator;

    public function __construct(Field_Manager $field, $control, $args = [])
    {
        $control = ucfirst(strtolower($control));
        if ($this->control_exist($control))
        {
            if (!strcmp($control, "Require"))
                $control = "LRequire";
            $control = __NAMESPACE__  . "\\" . "Control" . "\\" . $control;
            $this->validator = new $control($field, $args);
        }
        else
        {
            throw new \Exception("
                Try to add $control but this regex doesent exist", 1
            );
        }
    }

    /**
    *   Vérifie si le nom du control existe dans la liste des control de la
    *   librairie.
    *
    *   @return boolean
    */
    private function control_exist($control_name)
    {
        $control_list = ["Interval", "Max", "Min", "Require"];

        return (in_array($control_name, $control_list));
    }
}
