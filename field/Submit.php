<?php

namespace Src\Modeles\Form_Manager\Field;

use Src\Modeles\Form_Manager\Field_Manager;

class Submit extends Field_manager
{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->set_attr("value", $name);
    }
}
