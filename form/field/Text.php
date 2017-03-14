<?php

namespace Core\Html\Form\Field;

use Core\Html\Form\Field;

class Text extends Field{

    public function __construct($nom){
        parent::__construct($nom);

        $type = explode("\\", __CLASS__);
        $type = lcfirst(end($type));

        parent::addAttr('type', $type);
        parent::addAttr('name', $nom);
        parent::addAttr('require', TRUE);
    }

    public function isValid($post){
        return parent::isValid($post);
    }
}
?>
