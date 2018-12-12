<?php

namespace Form_manager;

use Form_manager\Manager_Trait;
use Form_manager\Regex_Manager;
use Form_manager\Control_Manager;
use Form_manager\Error_Manager;

abstract class Field_Manager
{
        /**
        *   @var string
        */
        private $name;

        /**
        *   @var array
        */
        private $attr = [];

        /**
        *   @var bool
        */
        private $require;

        /**
        *   @var bool
        */
        private $persist;

        /**
        *   @var Regex_Manager[]
        *   @var Control_Manager[]
        */
        private $checker = [];

        /**
        *   @var Error_Manager
        */
        private $error;

        use Manager_Trait;

        public function __construct($name)
        {
            $this->name = $name;
            $this->add_attr("name", $this->name);
            $this->type = end(explode("\\", get_class($this)));
            $this->add_attr("type", $this->type);
            $this->require = FALSE;
            $this->persist = FALSE;
        }

        public function get_name()
        {
            return ($this->name);
        }

        public function add_class($css_class)
        {
            if(gettype($css_class) === "string")
            {
                $this->css[] = $css_class;
            }
            return ($this);
        }

        public function add_attr($html_attr, $value = NULL)
        {
            if (array_key_exists($html_attr, $this->attr))
            {
                throw new \Exception("The attribut" . $html_attr . "is
                                     already added use set_attr() function
                                     to update it", 1);
            }
            if(gettype($html_attr) === "string")
            {
                $this->attr[$html_attr] = $value;
            }
            return ($this);
        }

        public function set_attr($html_attr, $value = NULL)
        {
            if (!strcmp($html_attr, "name"))
            {
                throw new \Exception("You are not allow to change the
                                      field name from this way use the form
                                      manager to set the name", 1);
            }
            if (!strcmp($html_attr, "type"))
            {
                throw new \Exception("You are not allow to setup the field
                                      type from fixed type use the unknow
                                      type to setup yours", 1);
            }
            if(gettype($html_attr) === "string")
            {
                $this->attr[$html_attr] = $value;
            }
            return ($this);
        }

        public function unset_attr($html_attr)
        {
            unset($this->attr[$html_attr]);
         }

        public function add_regex($regex, $specific = FALSE)
        {
            $regex = new Regex_Manager($this, $regex, $specific);
            $this->checker[] = $regex;
            return ($this);
        }

        public function add_control($control, $args)
        {
            $control = new Control_Manager($this, $control, $args);
            $this->checker[] = $control;
            return ($this);
        }

        public function add_error($error)
        {
            if (empty($this->checker))
            {
                throw new \Exception("Error, to set an error a checker
                                      must be set before.", 1);
            }
            $checker = end($this->checker);
            $checker->add_error($error);
            return ($this);
        }

        public function is_valid()
        {
            $no_error = TRUE;
            foreach ($this->checker as $value)
            {
                if (!$value->is_valid())
                {
                    $this->error = $value->get_error();
                    $no_error = FALSE;
                    break ;
                }
            }
            if (($no_error == TRUE || $this->persist === FALSE)
            && strcmp($this->type, "submit"))
            {
                $this->unset_attr("value");
            }
            return ($no_error);
        }

        public function get_error()
        {
            if ($this->error != NULL)
                return ($this->error);
        }

        public function persist()
        {
            $this->persist = TRUE;
            return ($this);
        }

        public function require()
        {
            $this->add_attr("require");
            $this->require = TRUE;
            return ($this);
        }

        public function get_html()
        {
            return ("<input " . $this->attr_to_string() . " />");
        }

        public function display()
        {
            echo("<input " . $this->attr_to_string() . " />");
        }
}
