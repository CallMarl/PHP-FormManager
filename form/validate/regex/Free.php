<?php

namespace Core\Html\Form\Validate\Regex;

use Core\Html\Form\Validate\AbstractRegex;

/*Le code source du script form, oblige à tout les input de posséder une regex,
Cette classe est une alternative à ce qui ne souhaite pas intégrer une regex dans
son input, ou utiliser un sytheme externe à ce code.

Dans mon cas, je souhaite ne pas utilisé de regex pour un imput de type file.*/

class Free extends AbstractRegex{

    public function isValid($string){
        return TRUE;
    }
}

?>
