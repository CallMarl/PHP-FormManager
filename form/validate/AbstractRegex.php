<?php

namespace Core\Html\Form\Validate;

abstract class AbstractRegex{

    private $error = '';

    public function getError(){
        return $this->error;
    }

    protected function setError($error){
        $this->error = $error;
    }

    public static function cleanAccent($string){
        $accent = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'à', 'á', 'â', 'ã', 'ä', 'å', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'ò', 'ó', 'ô', 'õ', 'ö',
                        'ø', 'È', 'É', 'Ê', 'Ë', 'è', 'é', 'ê', 'ë', 'Ç', 'ç', 'Ì', 'Í', 'Î', 'Ï', 'ì', 'í', 'î', 'ï', 'Ù', 'Ú', 'Û,', 'Ü',
                        'ù', 'ú', 'û', 'ü', 'ÿ', 'Ñ', 'ñ');
        $pasaccent = array('A', 'A', 'A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a', 'a', 'O', 'O', 'O', 'O', 'O', 'O', 'o', 'o', 'o', 'o', 'o',
                           'o', 'E', 'E', 'E', 'E', 'e', 'e', 'e', 'e', 'C', 'c', 'I', 'I', 'I', 'I', 'i', 'i', 'i', 'i', 'U', 'U', 'U,', 'U',
                           'u', 'u', 'u', 'u', 'y', 'N', 'n');

        return str_replace($accent, $pasaccent, $string);
    }

    //Suppression des caractère non imprimable (on garde CR ,LF et TAB)
    public static function cleanPrintable($string){
        $string = trim($string);
        return preg_replace('`[\x00\x08-\x0b\x0c\x0e\x19]`i', '', $string);
    }

    protected abstract function isValid($string);
}



?>
