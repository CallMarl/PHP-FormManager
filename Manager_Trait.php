<?php

namespace Form_Manager;

trait Manager_Trait
{
    /**
    *   @var array
    */
    private $css = [];

    public function add_class($css_class)
    {
        if(gettype($css_class) === "string")
        {
            $this->css[] = $css_class;
        }
        return ($this);
    }

    private function generate_class_attr()
    {
        if ($this->css != NULL)
        {
            $css_string = implode(" ", $this->css);
            $this->attr["class"] = $css_string;
        }
    }

    protected function attr_to_string()
    {
        $this->generate_class_attr();
        foreach ($this->attr as $key => $value)
        {
            $string_attr = "";
            $string_attr .= $key;
            if ($value != NULL)
                $string_attr .= " = " . "\"" . $value . "\"";
            $attr[] = $string_attr;
         }
         return (implode(" ", $attr));
    }
}
