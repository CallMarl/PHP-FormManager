<?php

namespace App\Modele\Form\Gabarit;

use App\Modele\Form\Form;
use App\Modele\Form\Error;

class SignIn extends Form{

    protected $error;

    public function __construct($action , $method = 'post'){
        parent::__construct($action , $method);
        $this->error = new Error();
    }

    public function loadForm(){

        $this->error->addClasses(['form-error', 'left-text', 'size-text-4', 'm-y-1', 'm-x-1']);
        #$this->addErrorHTML($this->error);
        parent::addErrorHTML($this->error);

        parent::addField(HTML_PSEUDO, 'text');
            $this->{HTML_PSEUDO}->addAttr('placeholder', 'Pseudo');
            $this->{HTML_PSEUDO}->addClasses(['table-item', 'col-xs-12', 'm-y-1', 'border-top-right-rad-4']);
            $this->{HTML_PSEUDO}->addRegex('alnum');

        parent::addField(HTML_PASSWORD, 'password');
            $this->{HTML_PASSWORD}->addAttr('placeholder', 'Password');
            $this->{HTML_PASSWORD}->addClasses(['table-item', 'col-xs-12', 'm-y-0']);
            $this->{HTML_PASSWORD}->addRegex('alnum');

        parent::addField(HTML_SUBMIT, 'submit');
            $this->{HTML_SUBMIT}->addClasses(['submit', 'col-xs-offset-6', 'col-xs-6', 'm-b-1']);
    }
}
?>
