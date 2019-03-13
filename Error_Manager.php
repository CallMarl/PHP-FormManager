<?php

namespace Form_Manager;

class Error_Manager
{
    /**
    *   @var array
    */
    private $attr = [];

    /**
    * @var string
    */
    private $error;

    /**
    * @var bool
    */
    private $faild;

    use Manager_Trait;

    public function __construct($error = NULL)
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

    public function set_error($error)
    {
        $this->error = $error;
    }

    public function add_attr($attr, $value = NULL)
    {
        $this->attr[$attr] = $value;
        return ($this);
    }

    public function unset_attr($html_attr)
    {
        unset($this->attr[$html_attr]);
    }

     public function display()
     {
         echo ($this->get_error());
     }
}

?>
