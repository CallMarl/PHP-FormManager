<?php

namespace Core\Html\Form\Field;

use Core\Html\Form\Field;

class Textarea extends Field{

    private $text;

    public function __construct($nom){
        parent::__construct($nom);

        $type = explode("\\", __CLASS__);
        $type = lcfirst(end($type));

        parent::addAttr('type', $type);
        parent::addAttr('name', $nom);
        parent::addAttr('require', TRUE);
    }

    #TODO amélioré ce champs.
    public function addText($text){
        $this->text = $text;
    }

    public function get_text(){
        return $this->text;
    }

    public function toHtml(){
        parent::addAttrClass();
        $html = '';
        return $html .= '<textarea ' . $this->attrs_toString() .'>' . $this->get_text() . '</textarea>';
    }

    public function isValid($post){
        return parent::isValid($post);
    }
}
?>
