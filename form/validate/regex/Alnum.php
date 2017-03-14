<?php

namespace Core\Html\Form\Validate\Regex;

use Core\Html\Form\Validate\AbstractRegex;

class Alnum extends AbstractRegex{

    private $space;

    public function __construct($space = TRUE){
        $this->space = $space;
    }

    public function isValid($string){
        if($this->space){
            if(preg_match('/[^[:alnum:]\s-]/i', $string)){
                parent::setError('Ce champs n\'accepte que des caractères alpha-numérique et les espaces :');
                return FALSE;
            }
            return TRUE;
        }
        if(preg_match('/[^[:alnum:]-]/i', $string)){
            parent::setError('Ce champs n\'accepte que des caractères alpha-numérique :');
            return FALSE;
        }
    }
}
?>
