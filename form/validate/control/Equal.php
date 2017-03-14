<?php

namespace Core\Html\Form\Validate\Control;

use Core\Html\Form\Validate\AbstractControl;

class Equal extends AbstractControl{

    private $fields;

    public function __construct($fields){

        if(count($fields) === 2){
            $this->fields = $fields;
        }
        else{
            #throw exception
        }
    }

    public function isValid(){
        if(strcmp($this->fields[0]->getAttr('value'), $this->fields[1]->getAttr('value')) === 0){
            return TRUE;
        }
        parent::setError('Les deux champs ne correspondent pas');
        return FALSE;
    }
}

?>
