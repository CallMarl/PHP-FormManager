<?php

namespace Src\Modeles\Form_manager;

use Src\Modeles\Form_manager\Manager_Trait;
use Src\Modeles\Form_manager\Error_Manager;

use Src\Modeles\Form_manager\Field\Text;
use Src\Modeles\Form_manager\Field\Password;
use Src\Modeles\Form_manager\Field\Select;
use Src\Modeles\Form_manager\Field\Submit;
use Src\Modeles\Form_manager\Field\Option;
use Src\Modeles\Form_manager\Field\Unknow;

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
        $this->set_method('get');
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

    public function add_text($name)
    {
        $this->add_field($name, "text");
        $field_name = strtolower($name);
        $this->$field_name = new Text($name);
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

    public function add_option($name)
    {
        $this->add_field($name, "option");
        $field_name = strtolower($name);
        $this->$field_name = new Option($name);
        return ($this);
    }

    public function add_submit($name)
    {
        $this->add_field($name, "submit");
        $field_name = strtolower($name);
        $this->$field_name = new Submit($name);
        return ($this);
    }

    public function add_unknow($name, $type)
    {
        if (in_array($type, ['text', 'password', 'select', 'submit']))
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

    private function check_form($post)
    {
        reset($this->fields);
        foreach ($post as $key => $value)
        {
            if (strcmp($key, current($this->field)))
                return (FALSE);
            next($this->field);
        }
    }

    public function is_valid($post, $hard = TRUE)
    {
        $no_error = TRUE;
        reset($post);
        foreach ($fields as $name => $type)
        {
            if ($hard == TRUE && !strcmp($name, current($post)))
                $no_error = FALSE;
            else
                $this->$name->set_attr("value", current($post));
            if (!$this->$name->is_valid())
                $no_error = FALSE;
            next($post);
        }
        return ($error);
    }

    public function set_method($method)
    {
        $method = strtolower($method);
        if (!in_array($method, ['post', 'get']))
            throw new \Exception("For a form method attribut could be only get
                                  or post", 1);
        $this->attr['method'] = $method;
    }

    public function set_action($action)
    {
        $this->attr['action'] = $action;
    }

    public function start()
    {
        echo("<form " . $this->attr_to_string() . " >");
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

    public function end()
    {
        echo("</form>");
    }
}
