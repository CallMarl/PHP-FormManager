<?php

namespace Form_Manager;

use Form_Manager\Field_Manager;
use Form_Manager\Regex\Specific;

class Caller_Regex
{
    /**
    *   Ensemble de fonction permettant la gestion des validateurs.
    */
    use Trait_Validator;

    public function __construct(Field_Manager $field, $regex, $specific = FALSE)
    {
        $regex = ucfirst(strtolower($regex));

        if ($this->is_regex($regex) && $specific == FALSE)
        {
            $regex = __NAMESPACE__  . "\\" . "Regex" . "\\" . $regex;
            $this->validator = new $regex($field);
        }
        else if ($specific == TRUE)
            $this->validator = new Specific($field, $specific);
        else
        {
            throw new \Exception("
                Try to add " . $regex . " but this regex type doesn't
                exist", 1
            );
        }
    }

    /**
    *   Vérifie si le nom de la regex existe dans la liste des regex de la
    *   librairie.
    *
    *   @return boolean
    */
    private function is_regex($regex)
    {
        $regex_list = ["Alpha", "Mail"];

        return (in_array($regex, $regex_list));
    }
}
