<?php

namespace Form_Manager;

use Form_Manager\Manager_Trait;
use Form_Manager\Regex_Manager;
use Form_Manager\Control_Manager;
use Form_Manager\Error_Manager;

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
        private $persist;

        /**
        *   @var Regex_Manager[]
        *   @var Control_Manager[]
        */
        private $checker = [];

        /**
        *   @var Error_Manager
        */
        protected $error;

        /**
        *   @var string
        */
        private $type;

        use Manager_Trait;

        public function __construct($name)
        {
            $this->name = $name;
            $class_name = explode("\\", get_class($this));
            $this->type = strtolower(end($class_name));
            $this->error = new Error_Manager("The field " . $this->name .
                                             " was modified");
            $this->add_attr("name", $this->name);
            $this->add_attr("type", $this->type);
            $this->persist();
        }

        public function get_name()
        {
            return ($this->name);
        }

        public function get_attr($type)
        {
            if (isset($this->attr[$type]))
                return ($this->attr[$type]);
            return (NULL);
        }

        public function add_class($css_class)
        {
            if(gettype($css_class) === "string")
            {
                $this->css[] = $css_class;
            }
            return ($this);
        }

        public function set_error($error_message)
        {
            $this->error = new Error_Manager($error_message);
            return ($this);
        }

        public function unset_error()
        {
            unset($this->error);
        }

        public function add_attr($html_attr, $value = NULL)
        {
            if (array_key_exists($html_attr, $this->attr))
            {
                throw new \Exception("The attribut " . $html_attr . " is
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
            return (end($this->checker));
        }

        public function add_control($control, $args = [])
        {
            $control = new Control_Manager($this, $control, $args);
            $this->checker[] = $control;
            return (end($this->checker));
        }

        public function add_checker($callback)
        {
            $checker = new Checker_Manager($this, $callback);
            $this->checker[] = $checker;
            return (end($this->checker));
        }

        public function is_valid()
        {
            $no_error = TRUE;
            foreach ($this->checker as $value)
            {
                if (!$value->is_valid())
                {
                    $this->error = new Error_Manager($value->get_error());
                    $no_error = FALSE;
                    break ;
                }
            }
            if ($no_error == FALSE)
                    $this->error->set_faild();
            if ($no_error == FALSE || $this->persist == FALSE)
                $this->unset_attr("value");
            return ($no_error);
        }

        public function get_error()
        {
            if (isset($this->error) && $this->error->is_faild())
                return ($this->error->get_error());
        }

        public function display_error()
        {
            echo($this->get_error());
        }

        public function persist()
        {
            if ($this->persist == TRUE)
                $this->persist = FALSE;
            else
                $this->persist = TRUE;
            return ($this);
        }

        public function is_persist()
        {
            return ($this->persist);
        }

        public function disabled()
        {
            if ($this->get_attr("disabled") == NULL)
                $this->add_attr("disabled");
            return ($this);
        }

        public function is_disabled()
        {
            if ($this->get_attr("disabled") !== NULL)
                return (TRUE);
            return (FALSE);
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
