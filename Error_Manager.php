<?php

namespace Form_Manager;

class Error_Manager
{
    /**
    * @var string
    */
    private $error;

    /**
    * @var bool
    */
    private $faild;

    public function __construct($error)
    {
        $this->error = $error;
        $this->faild = FALSE;
    }

    public function set_faild()
    {
        $this->faild = TRUE;
    }

    public function is_faild()
    {
        return ($this->faild);
    }

    public function get_error()
    {
        return ($this->error);
    }
}

?>
