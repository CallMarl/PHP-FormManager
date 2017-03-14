<?php

namespace App\Modele\Form\Gabarit;

use App\Modele\Form\Form;
use App\Modele\Form\Error;

Class Upload extends Form{

    protected $error;

    public function __construct($action , $method = 'post'){
        parent::__construct($action , $method);
        $this->error = new Error();
    }

    public function loadForm(){

        $this->error->addClasses(['form-error', 'left-text', 'size-text-4', 'm-y-1', 'm-x-1']);
        parent::addErrorHTML($this->error);

        parent::addAttr('enctype', 'multipart/form-data');

        parent::addField(HTML_FILENAME, 'text');
            $this->{HTML_FILENAME}->addAttr('placeholder', 'nom du fichier');
            $this->{HTML_FILENAME}->addClasses(['table-item', 'col-xs-12', 'm-y-1', 'border-top-right-rad-4']);
            $this->{HTML_FILENAME}->addRegex('alnum');

        parent::addField(HTML_UPLOAD, 'file');

        parent::addField(HTML_SUBMIT_1, 'submit');
            $this->{HTML_SUBMIT_1}->addClasses(['submit', 'col-xs-offset-6', 'col-xs-6', 'm-b-1']);
    }

}

?>
