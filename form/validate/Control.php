<?php

namespace Core\Html\Form\Validate;

class Control{

    private $control;

    public function __construct(){
        $this->control = array();
    }

    private function controlExiste($type){
        return file_exists(ROOT . '\\' . __NAMESPACE__ . '\Control\\' . $type . '.php');
    }

    public function addControl($type, $fields = [], $seterror = ''){
        $type = ucfirst(strtolower($type));
        if($this->controlExiste($type)){
            $class = __NAMESPACE__ . '\Control\\' . $type;
            $control = new $class($fields);

            if($seterror !== ''){
                $control->setError($seterror);
            }

            $this->control[] = $control;
        }
        else{
            #throw exception;
        }
    }

    public function isValid(){
        foreach ($this->control as $value) {
            if(!$value->isValid()){
                $errors[] = $value->getError();
            }
        }
        if(!empty($errors)){
            return $errors;
        }
        else {
            return TRUE;
        }
    }
}
?>
