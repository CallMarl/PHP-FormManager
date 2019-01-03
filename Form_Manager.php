<?php

namespace Form_Manager;

use Form_Manager\Manager_Trait;
use Form_Manager\Error_Manager;
use Form_Manager\Field\Date;
use Form_Manager\Field\Option;
use Form_Manager\Field\Password;
use Form_Manager\Field\Select;
use Form_Manager\Field\Submit;
use Form_Manager\Field\Text;
use Form_Manager\Field\Unknow;

class Form_Manager
{
    /**
    *   @var array
    */
    private $attr = [];

    /**
    *   @var array
    */
    private $fields = [];

    /**
    *   @var Error_Manager
    */
    private $error;

    use Manager_Trait;

    public function __construct()
    {
        $this->set_action("#");
        $this->set_get();
        $this->error = new Error_Manager('To edit this message you can use set_
                                         error() function or remove it with the
                                         unset_error() function.');
    }

    public function __get($var)
    {
        return ($this->var);
    }

    private function add_field($name, $type)
    {
        if (array_key_exists($name, $this->fields))
            throw new \Exception("Each field name must be different", 1);
        $this->fields[$name] = $type;
    }

    public function add_date($name)
    {
        $this->add_field($name, "date");
        $field_name = strtolower($name);
        $this->$field_name = new Date($name);
        return ($this);
    }

    public function add_option($name)
    {
        $this->add_field($name, "option");
        $field_name = strtolower($name);
        $this->$field_name = new Option($name);
        return ($this);
    }

    public function add_password($name)
    {
        $this->add_field($name, "password");
        $field_name = strtolower($name);
        $this->$field_name = new Password($name);
        return ($this);
    }

    public function add_select($name)
    {
        $this->add_field($name, "select");
        $field_name = strtolower($name);
        $this->$field_name = new Select($name);
        return ($this);
    }

    public function add_submit($name)
    {
        $this->add_field($name, "submit");
        $field_name = strtolower($name);
        $this->$field_name = new Submit($name);
        return ($this);
    }

    public function add_text($name)
    {
        $this->add_field($name, "text");
        $field_name = strtolower($name);
        $this->$field_name = new Text($name);
        return ($this);
    }

    public function add_unknow($name, $type)
    {
        if (in_array($type, ['text', 'password', 'select', 'submit', 'date', 'option']))
        {
            throw new \Exception("There is a specific functionfor this type : "
                                  . $type, 1);
        }
        $field_name = strtolower($name);
        $this->$field_name = new Unknow($name, $type);
        return ($this);
    }

    public function set_error($error)
    {
        $this->error = new Error_Manager($error);
        return ($this);
    }

    public function unset_error()
    {
        unset($this->error);
    }

    public function is_valid($post, $hard = TRUE)
    {
        reset($this->fields);
        $tmp = TRUE;
        $tmp_post = $post;
        foreach ($this->fields as $key => $value)
        {
            if (array_key_exists($key, $tmp_post))
            {
                if($hard == TRUE && strcmp($tmp_post[$key], current($tmp_post)))
                {
                    $this->error->set_faild();
                    $tmp = FALSE;
                }
                $this->$key->set_attr("value", $tmp_post[$key]);
                unset($tmp_post[$key]);
            }
            if (!$this->$key->is_valid())
                $tmp = FALSE;
        }
        if ($hard == TRUE && !empty($tmp_post))
        {
            $this->error->set_faild();
            $tmp = FALSE;
        }
        return ($tmp);
    }

    public function set_post()
    {
        $this->attr['method'] = 'post';
        return ($this);
    }

    public function set_get()
    {
        $this->attr['method'] = 'get';
        return ($this);
    }

    public function set_action($action)
    {
        $this->attr['action'] = $action;
        return ($this);
    }

    public function start()
    {
        echo("<form " . $this->attr_to_string() . " >");
    }

    public function end()
    {
        echo("</form>");
    }

    public function get_html()
    {
        $html = "";
        foreach ($this->fields as $key => $value)
        {
            $key = strtolower($key);
            $html .= $this->$key->get_html();
        }
        return ($html);
    }

    public function display()
    {
        foreach ($this->fields as $key => $value)
            $this->$key->display();
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
}
