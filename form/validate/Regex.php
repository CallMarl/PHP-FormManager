<?php

namespace Core\Html\Form\Validate;

class Regex{

    private $regex;

    public function __construct(){
        $this->regex = array();
    }

    /**
     *@var $type => nom de regex vérifie que la regex demandé existe.
     *@return boolval
     */
    private function regexExist($type){
        return file_exists(ROOT . '\\' . __NAMESPACE__ . '\Regex\\' . $type . '.php');
    }

    /**
     *@var $type => type de regex demandé
     *@var $setError => personnalisation du mot de passe
     */
    public function addRegex($type, $seterror = ''){
        $type = ucfirst(strtolower($type));
        if($this->regexExist($type)){
            $class = __NAMESPACE__ . '\Regex\\' . $type;
            $regex = new $class();

            if($seterror !== ''){
                $regex->setError($seterror);
            }

            $this->regex = $regex;
        }
        else{
            #throw exception;
        }
    }

    /**
     *@var $post => $_POST['valeur'] au cas par cas.
     *@return boolval
     */
    public function isValid($post){
        if(!$this->regex->isValid($post)){
            return $this->regex->getError();
        }
        return TRUE;
    }
}
?>
