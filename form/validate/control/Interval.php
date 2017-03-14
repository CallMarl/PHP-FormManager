<?php

namespace App\Modele\Form\Validate\Control;

use App\Modele\Form\Validate\AbstractControl;

class Interval extends AbstractControl{

    private $field;
    private $min;
    private $max;

    public function __construct($params){
        if(count($params) === 3){
            $this->field = $params[0];
            $this->min = $params[1];
            $this->max = $params[2];
        }
        else{
            #throw exception Interval class word with: one field, one max value, one low value.
        }
    }

    public function IsValid(){
        $len = strlen($this->field->getAttr('value'));
        if($this->min <= $len &&  $len <= $this->max){
            return TRUE;
        }
        parent::setError('Le champs ne respect pas la bon nombre de caractère');
        return FALSE;
    }


}

?>
