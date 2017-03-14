<?php

namespace Core\Html\Form;

require_once(__DIR__ . DIRECTORY_SEPARATOR . '__errorlog.php');

use Core\Html\Error\Error;
use Core\Html\Form\Validate\Control;

class Form{

    private $attrs;

    private $fields;
    private $uniqid;
    private $control;

    private $error;

    public function __construct($action , $method = 'post'){
        $this->attrs['action'] = $action;
        $this->attrs['enctype'] = '';

        $method = strtolower($method);
        if(in_array($method, array('post', 'get'))){
            $this->attrs['method'] = $method;
        }
        else{
            $this->attrs['method'] = 'post';
        }
    }

    public function addAttr($attr, $value){
        $this->attrs[$attr] = $value;
    }

    #sert à ajouter un champs du type que l'on souhaite.
    #A chaque appel cet fonction va ajouté une nouvelle instance de Field à la class Form
    public function addField($nom, $type){
        if($nom !== 'uniqid' || $nom !== 'attrs' || $nom !== 'fields'){ #$nom !== 'field_submit'

            #vérifier performance de cette update
            if(ucfirst($type) === 'File' && $this->attrs['enctype'] !== 'multipart/form-data'){
                $this->attrs['enctype'] = 'multipart/form-data';
            }
            #fin update

            $field = 'Core\Html\Form\Field\\' . ucfirst($type);
            $this->$nom = new $field($nom);

            if(lcfirst($type) !== 'submit'){
                $this->fields[$nom] = lcfirst($type);
            }
        }
        else{
            throw new \Exception('script need terms uniqid, attrs and fields you can\'t use them');
        }
    }

    #sert à ajouté un champs caché.
    public function addUniqId($uniqid){
        if(!isset($this->uniqid)){
            $this->uniqid = $uniqid;
            $this->addFiel('uniq', 'text')->addAttr('hidden', TRUE);
        }
    }

    #sécurité suplémentaire à intégré dans le cas ou l'on à ajouté un champs
    #caché avec la méthode addUniqId($uniqId);
    private function isUniqId(){
        if(isset($this->uniqid)){
            $method = ($this->attrs['method'] === 'post') ? $_POST : $_GET;
            if (!empty($method['uniqid']) && $method['uniqid'] == $this->uniqid){
                return TRUE;
            }
        return FALSE;
        }
    }

    public function addControl($type, $fields = [], $setError = ''){
        if(!is_object($this->control)){
            $this->control = new Control();
        }
        $this->control->addControl($type, $fields, $setError);
    }

    public function isValid($post){
        if($this->isUniqId() === FALSE){
            return FALSE;
        }
        foreach ($this->fields as $key => $value){
            $postvar = preg_replace('/\[|]/','', $key);
            if(isset($post[$postvar])){
                if(!$this->$key->isValid($post[$postvar])){
                    $this->error[] = $this->$key->getError();
                    $this->$key->deleteAttr('value');
                }
            }
            else{
                $this->error = FORM_ERROR;
                return FALSE;
            }
        }
        if(isset($this->error)){
            return FALSE;
        }

        if(is_object($this->control)){
            $validation = $this->control->isValid();
            if($validation !== TRUE){
                $this->error = $validation;
                return FALSE;
            }
        }
        return TRUE;
    }

    /*Transforme le tableau d'attribut en une ligne de code utilisable avec HTML*/
    private function attrs_toString(){
        $attrs = '';
        foreach ($this->attrs as $key => $value){
            $attrs .= $key . '="' . $value . '" ';
        }
        return $attrs;
    }

    public function start(){
        return '<form ' . $this->attrs_toString() .'/> ';
    }

    public function end(){
        return '</form>';
    }

    public function updateValue($post){
        foreach ($this->fields as $key => $value){
            if(isset($post[$this->$key->getName()])){
                $this->$key->addAttr('value', htmlspecialchars($post[$this->$key->getName()]));
            }
        }
    }

    public function addErrorHTML(Error $error){
        $this->errorHtml = $error;
    }

    public function getError(){
        if(isset($this->error)){
            return $this->error;
        }
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
