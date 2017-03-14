<?php

namespace Core\Html\Form\Field;

use Core\Html\Form\Field;

class Submit extends Field{

    public function __construct($nom){
        parent::__construct($nom);

        $type = explode("\\", __CLASS__);
        $type = lcfirst(end($type));

        parent::addAttr('type', $type);
        parent::addAttr('value', $nom);
        #@TODO vérifier si un attribut nom est ajouter si $POST[nom] = value;
    }
}
?>
