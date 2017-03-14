<?php

namespace Core\Html\Form\Validate;

abstract class AbstractControl{

    private $error = '';

    public function getError(){
        return $this->error;
    }

    protected function setError($error){
        $this->error = $error;
    }

    abstract function isValid();
}

?>
