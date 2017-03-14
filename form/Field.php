<?php

namespace Core\Html\Form;

require_once(__DIR__ . DIRECTORY_SEPARATOR . '__errorlog.php');

use Core\Html\Error\Error;
use Core\Html\Form\Validate\Regex;

class Field{

    protected $name;

    protected $regex;
    protected $class;
    protected $attrs;

    protected $error;

    protected function __construct($name){
        $this->name = $name;
        $this->class = array();
        $this->attrs = array();
    }

    public function addRegex($type, $seterror = ''){
        if(!is_object($this->regex)){
            $this->regex = new Regex();
        }
        $this->regex->addRegex($type, $seterror = '');
    }

    public function getName(){
        return $this->name;
    }

    /*Ajoute une class css au champs*/
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

    /*Change une classe css du champs*/
    public function setClass($oldclass, $newclass){
        foreach ($this->class as &$value) {
            if(strcmp($value, $oldclass) === 0){
                $value = $newclass;
            }
        }
    }

    /*Suprime une class css du champs*/
    public function deleteClass($class){
        foreach ($this->class as $key => $value) {
            if(strcmp($value, $class) === 0){
                unset($this->class[$key]);
            }
        }
        $this->class = array_values($this->class);
    }

    /*Cette fonction véririfie L'existance d'un attribut dans le tabelau attr.php
      Si oui elle retourne le type de l'attribut,
      Si non elle renvois null.*/
    private static function existingAttrs($attr){
        $file = require('__attrs.php');
        foreach ($file as $key => $value) {
            if(strcmp($key, $attr) === 0){
                return $value;
            }
        }
        return NULL;
    }

    /*Rajoute l'attribut à l'input si il existe*/
    public function addAttr($attr, $value){
        $attrExist = self::existingAttrs($attr);
        if($attrExist !== NULL){
            if(strcmp(gettype($value), $attrExist) === 0){
                $this->attrs[$attr] = $value;
            }
        }
    }

    public function getAttr($attr){
        if(isset($this->attrs[$attr])){
            return $this->attrs[$attr];
        }
        #erreur
    }

    /*Change la valeur de l'attribut si il existe déja dans le tableau d'attribut*/
    public function setAttr($attr, $value){
        if(isset($this->attrs[$attr])){
            $this->attrs[$attr] = $value;
        }
    }

    /*Suprime un attribut du champs*/
    public function deleteAttr($attr){
        if(isset($this->attrs[$attr])){
            unset($this->attrs[$attr]);
        }
    }

    protected function addAttrClass(){
        if(!empty($this->class)){
            $this->addAttr('class', implode(' ', $this->class));
        }
    }

    #@TODO Ajouter une condition pour le champ d'erreur if(isset($this->attrs['placeholder'])) else use $this->name
    protected function isValid($post){

        if($this->getAttr('require') !== NULL){
            if(!$this->getAttr('require') && empty($post)){
                return TRUE;
            }
            else if($this->getAttr('require') && empty($post)){
                $this->error = NEED_FIELD . $this->attrs['name'];
                return FALSE;
            }
        }

        if(is_object($this->regex)){
            $validation = $this->regex->isValid($post);
            if($validation !== TRUE){
                $this->error = $validation;
                return FALSE;
            }
            return TRUE;
        }
        else{
            throw new \Exception('Le champs doit être sécurisé: ' .  $this->attrs['name']);
            return TRUE;
        }

    }

    /*Transforme le tableau d'attribut en une ligne de code utilisable avec HTML*/
    protected function attrs_toString(){
        $attrs = '';
        foreach ($this->attrs as $key => $value){
            $attrs .= $key . '="' . $value . '" ';
        }
        return $attrs;
    }

    public function toHtml(){
        $this->addAttrClass();
        $html = '';
        return $html .= '<input ' . $this->attrs_toString() .'/> ';
    }

    public function getError(){
        if(isset($this->error)){
            return $this->error;
        }
    }

    public function addErrorHTML(Error $error){
        $this->errorHtml = $error;
    }

    public function printError(){
        if($this->getError() !== NULL){
            if(isset($this->errorHtml)){
                $this->errorHtml->addError($this->getError());
            }
            else{
                $this->errorHtml = new Error();
                $this->errorHtml->addError($this->getError());
            }
            return $this->errorHtml->toHtml();
        }
    }
}
?>
