<?php

namespace Core\Html\Form\Field;

use Core\Html\Form\Field;

class File extends Field{

    private $extension;
    private $size;

    #@TODO définir des extension par default et une taille par default;
    public function __construct($nom){
        parent::__construct($nom);

        $type = explode("\\", __CLASS__);
        $type = lcfirst(end($type));

        parent::addAttr('type', $type);
        parent::addAttr('name', $nom);
    }

    public function setExtention($extension = []){
        $this->extension = $extension;
    }

    public function setSizeLimit($size){
        $this->size = $size;
    }

    private function ordered(&$files){
        foreach($files as $key => $value){
            if(is_array($value)){
                $keylist = array_keys($files);
                $size = count($value);
                unset($tmp);
                for($i = 0; $i < $size; $i++){
                    foreach($keylist as $key){
                        $tmp[$i][$key] = $files[$key][$i];
                    }
                }
                break;
            }
            else{
                $tmp[] = $files;
                break;
            }
        }
        $files = $tmp;
    }

    private function check_error($fileError){
        switch ($fileError){
            case 0:
                return TRUE;
            case 3:
                $this->error = 'Le fichier n\'a été que partiellement téléchargé veuillez recommencer.';
                return FALSE;
            case 4:
                $this->error = ' Aucun fichier n\'a été téléchargé.';
                return FALSE;
            #case 1:
            #    $this->error = 'La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini';
            #    return FALSE;
            #case 2:
            #    $this->error = 'La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML';
            #    return FALSE;
            #case 6:
            #    $this->error = 'Un dossier temporaire est manquant';
            #    return FALSE;
            #case 7:
            #    $this->error = 'Échec de l\'écriture du fichier sur le disque. ';
            #    return FALSE;
            #case 8:
            #    $this->error = 'ne extension PHP a arrêté l\'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L\'examen du phpinfo() peut aider.'
            #    return FALS
        }
    }

    private function check_extension($filename){
        $file_extension = explode('.', $filename);
        $file_extension = end($file_extension);
        if(!in_array($file_extension, $this->extension)){
            $this->error = "Le format du fichier n'est pas accepté";
            return FALSE;
        }
        return TRUE;
    }

    private function check_size($filesize){
        if($filesize > $this->size){
            $this->error = "Les fihier sont trop imposant veuillez réduire leur taille";
            return FALSE;
        }
        return TRUE;
    }

    public function isValid($files){
        $this->ordered($files);
        foreach($files as $file){
            if(!$this->check_error($file['error']) || !$this->check_extension($file['name']) || !$this->check_size($file['size'])){
                return FALSE;
            }
        }
        return TRUE;
    }
}
?>
