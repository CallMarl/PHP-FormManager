<?php

namespace Core\Html\Form\Field;

use Core\Html\Form\Field;

class Listing extends Field{

    protected $otpion;

    public function __construct($nom){
        $this->option = array();

        parent::addAttr('name', $nom);
        parent::addAttr('require', TRUE);
    }

    public function addOption($name){
        $this->option[$name] = new Option($name, $name);
    }

    public function getOption($name){
        return $this->option[$name]->getValue();
    }

    public function deleteOption($name){
        if(isset($this->option[$name])){
            unset($this->option[$name]);
        }
    }

    private function optionToHTML(){
        $html = '';
        foreach ($this->option as $value) {
            $html .= $value->toHtml();
        }
        return $html;
    }

    public function toHtml(){
        parent::addAttrClass();
        $html = '';
        return $html .= '<select ' . $this->attrs_toString() .'>' . $this->optionToHtml() . '</select>';
    }

    public function IsValid($post){
        if(!isset($this->option[$post])){
            $this->error = 'Vous avez tenter de modifier la liste';
            return FALSE;
        }
        else{
            $this->option[$post]->addAttr('selected', TRUE);
        }
        return parent::isValid($post);
    }
}

class Option extends Field{

    public function __construct($nom, $value){
        parent::addAttr('name', $nom);
        $this->value = $value;
    }

    public function toHtml(){
        return '<option ' . $this->attrs_toString() . '>' . $this->value . '</option>';
    }

    public function getValue(){
        return $this->value;
    }
}

?>
