<?php

namespace Core\Html;

class Error{

    protected $class;
    protected $error;

    public function __construct(){
        $this->class = array();
        $this->error = array();
    }

    public function addError($error){
        $this->error = $error;
    }

    public function addClass($class){
        if(gettype($class) === "string"){
            $this->class[] = $class;
        }
    }

    /*Ajoute des classe css au champs*/
    public function addClasses($classes =[]){
        foreach ($classes as $value) {
            if(gettype($value) === "string"){
                $this->class[] = $value;
            }
        }
    }

    public function toHtml(){
        $html = '';
        if(!empty($this->error)){
            if(is_array($this->error)){
                foreach ($this->error as $value) {
                    $html .= '<p class="' .implode(' ', $this->class) . '">'.$value.'</p>';
                }
            }
            else{
                $html = '<p class="' .implode(' ', $this->class) . '">'.$this->error.'</p>';
            }
        }
        return $html;
    }
}
?>
