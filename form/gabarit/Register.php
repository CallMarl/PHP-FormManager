<?php

namespace App\Modele\Form\Gabarit;

use App\Modele\Form\Form;
use App\Modele\Form\Error;

class Register extends Form{

    protected $error;

    public function __construct($action, $method = 'post'){
        parent::__construct($action , $method);
        $this->error = new Error();
    }

    public function loadForm(){

        $this->error->addClasses(['form-error', 'left-text', 'size-text-4', 'm-y-1', 'm-x-1']);
        parent::addErrorHTML($this->error);

        /*
        parent::addField(HTML_NAME, 'text' );
            $this->{HTML_NAME}->addAttr('placeholder', 'Prenom');
            $this->{HTML_NAME}->addClasses(['table-item', 'col-xs-12', 'm-y-1', 'border-top-right-rad-4']);
            $this->{HTML_NAME}->addRegex('alnum');
            parent::addControl('interval',[$this->{HTML_NAME}, 3, 24]);

        parent::addField(HTML_SURNAME, 'text');
            $this->{HTML_SURNAME}->addAttr('placeholder', 'Nom');
            $this->{HTML_SURNAME}->addClasses(['table-item', 'col-xs-12', 'm-b-1']);
            $this->{HTML_SURNAME}->addRegex('alnum');
            parent::addControl('interval',[$this->{HTML_SURNAME}, 3, 24]);

        parent::addField(HTML_COUNTRY, 'listing');
            $this->{HTML_COUNTRY}->addOption('Fance');
            $this->{HTML_COUNTRY}->addOption('Espagne');
            $this->{HTML_COUNTRY}->addOption('Italy');
            $this->{HTML_COUNTRY}->addClasses(['table-item', 'col-xs-12', 'border-bottom-right-rad-4']);
            $this->{HTML_COUNTRY}->addRegex('alpha');
        */

        parent::addField(HTML_PSEUDO, 'text');
            $this->{HTML_PSEUDO}->addAttr('placeholder', 'Pseudo');
            $this->{HTML_PSEUDO}->addClasses(['table-item', 'col-xs-12', 'm-y-1', 'border-top-right-rad-4']);
            $this->{HTML_PSEUDO}->addRegex('alnum');
            parent::addControl('interval', [$this->{HTML_PSEUDO}, 5, 55]);

        parent::addField(HTML_MAIL, 'text');
            $this->{HTML_MAIL}->addAttr('placeholder', 'Email');
            $this->{HTML_MAIL}->addClasses(['table-item', 'col-xs-12', 'm-b-1']);
            $this->{HTML_MAIL}->addRegex('mail');
            parent::addControl('interval', [$this->{HTML_MAIL}, 5, 255]);

        parent::addField(HTML_PASSWORD, 'password');
            $this->{HTML_PASSWORD}->addAttr('placeholder', 'Password');
            $this->{HTML_PASSWORD}->addClasses(['table-item', 'col-xs-12', 'm-b-1']);
            $this->{HTML_PASSWORD}->addRegex('alnum');
            parent::addControl('interval', [$this->{HTML_PASSWORD}, 5, 55]);

        parent::addField(HTML_CHECKPASSWORD, 'password');
            $this->{HTML_CHECKPASSWORD}->addAttr('placeholder', 'Check Password');
            $this->{HTML_CHECKPASSWORD}->addClasses(['table-item', 'col-xs-12', 'm-b-1', 'border-bottom-right-rad-4']);
            $this->{HTML_CHECKPASSWORD}->addRegex('alnum');
            parent::addControl('interval', [$this->{HTML_CHECKPASSWORD}, 5, 55]);

        parent::addControl('equal', [$this->{HTML_PASSWORD}, $this->{HTML_CHECKPASSWORD}]);

        parent::addField(HTML_SUBMIT_1, 'submit');
            $this->{HTML_SUBMIT_1}->addClasses(['submit', 'col-xs-offset-6', 'col-xs-6', 'm-b-1']);
    }
}

?>
