<?php

/* version public d'un formulaire de contact*/

namespace App\Modele\Form\Gabarit;

use App\Modele\Form\Form;
use App\Modele\Form\Error;

Class Contact extends Form{

    protected $error;

    public function __construct($action, $method = 'post'){
        parent::__construct($action , $method);
        $this->error = new Error();
    }

    public function loadForm(){
        $this->error->addClasses(['','']);
        parent::addErrorHTML($this->error);

        parent::addField(HTML_NAME, 'text');
            $this->{HTML_NAME}->addAttr('placeholder', 'value?');
            $this->{HTML_NAME}->addClasses(['table-item', 'col-xs-12', 'm-y-1', 'border-top-right-rad-4']);
            $this->{HTML_NAME}->addRegex('alnum');
            $this->{HTML_NAME}->addErrorHTML($this->error);

        parent::addField(HTML_MAIL, 'text');
            $this->{HTML_MAIL}->addAttr('placeholder', 'value?');
            $this->{HTML_MAIL}->addClasses(['table-item', 'col-xs-12', 'm-b-1']);
            $this->{HTML_MAIL}->addRegex('mail');
            $this->{HTML_MAIL}->addErrorHTML($this->error);

        parent::addField(HTML_MESSAGE, 'textarea');
            $this->{HTML_MESSAGE}->addAttr('placeholder', 'value');
            $this->{HTML_MESSAGE}->addClasses(['table-item', 'col-xs-12', 'm-b-1', 'border-bottom-right-rad-4']);
            $this->{HTML_MESSAGE}->addRegex('alnum');
            $this->{HTML_MESSAGE}->addErrorHTML($this->error);

        parent::addField(HTML_SUBMIT, 'submit');
            $this->{HTML_SUBMIT}->addClasses(['submit', 'col-xs-offset-6', 'col-xs-6', 'm-b-1']);
    }
}


?>
