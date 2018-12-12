<?php

namespace Src\Modeles\Form_Manager;

class Error_Manager
{
    /**
    * @var string
    */
    private $error;

    public function __construct($error)
    {
        $this->error = $error;
    }

    public function get_error()
    {
        return ($this->error);
    }
}

?>
