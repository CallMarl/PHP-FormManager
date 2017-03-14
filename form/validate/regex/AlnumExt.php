<?php

namespace Core\Html\Form\Validate\Regex;

use Core\Html\Form\Validate\AbstractRegex;

class AlnumExt extends AbstractRegex{

    private $space;

    public function __construct($space = TRUE){
        $this->space = $space;
    }

    public function isValid($string){
        if($this->space){
            if(!preg_match('/[^\\{}<>\[\]]+/i', $string)){
                parent::setError('Ce champs n\'accepte pas les caractères spéciaux:');
                return FALSE;
            }
            return TRUE;
        }
        if(!preg_match('/[^\\{}<>\[\] ]+/i', $string)){
            parent::setError('Ce champs attends qu\'un seul term et n\accepte pas les caractères spéciaux:');
            return FALSE;
        }
    }
}


?>
