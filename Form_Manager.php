<?php

namespace Form_Manager;

use Form_Manager\Error_Manager;
use Form_Manager\Field\Date;
use Form_Manager\Field\Option;
use Form_Manager\Field\Password;
use Form_Manager\Field\Select;
use Form_Manager\Field\Submit;
use Form_Manager\Field\Text;
use Form_Manager\Field\Textarea;
use Form_Manager\Field\Unknow;
use Form_Manager\Trait_Error;
use Form_Manager\Trait_Manager;

class Form_Manager
{
    /**
    *   Ensemble de fonctions utile et concordante entre les différents Manager.
    */
    use Trait_Manager;

    /**
    *   Ensemble de fonction permettant la gestion des erreur.
    */
    use Trait_Error;

    /**
    *   @var array
    */
    private $attr = [];

    /**
    *   @var array
    */
    private $fields = [];

    /**
    *   Par défaut deux attributs sont définit dans le gestionnaire de
    *   formulaire, l'action pointé par celui-ci et ça méthode définit à get.
    */
    public function __construct()
    {
        $this->add_attr('action', '#');
        $this->add_attr('method', 'get')
        $this->error = new Error_Manager('
            To edit this message you can use set_error() function or remove it
            with the unset_error() function.'
        );
    }

    /**
    *   Fonction retournant la variable génériquement créer avec les fonction du
    *   type add_field(). Le name correspond au nom indiqué dans les champs de
    *   type add_field().
    *
    *   @param      string $name
    *   @return     Field_Manager
    */
    public function __get($name)
    {
        return ($this->name);
    }

    /**
    *   Fonction qui sauvegarde le nom du champs dans un tableau, ce tableau
    *   permet notament de vérifier si la structure du formulaire à été modifier
    *   une exception est retourné, si deux champs dans le formulaire portent le
    *   meme nom.
    *
    *   @param       string $name
    *   @param       string $type
    *
    */
    private function add_field($name, $type)
    {
        if (array_key_exists($name, $this->fields))
            throw new \Exception("Each field name must be different", 1);
        $this->fields[$name] = $type;
    }

    /**
    *   Fonction créant une instance du champs date.
    *
    *   @param       string $name
    *   @return     Form_Manager\Field\Date;
    */
    public function add_date($name)
    {
        $this->add_field($name, "date");
        $field_name = strtolower($name);
        $this->$field_name = new Date($name, $this->new_error());
        return ($this);
    }

    /**
    *   Fonction créant une instance du champs option.
    *
    *   @param      string $name
    *   @return     Form_Manager\Field\Option;
    */
    public function add_option($name)
    {
        $this->add_field($name, "option");
        $field_name = strtolower($name);
        $this->$field_name = new Option($name, $this->new_error());
        return ($this);
    }

    /**
    *   Fonction créant une instance du champs password.
    *
    *   @param      string $name
    *   @return     Form_Manager\Field\Password;
    */
    public function add_password($name)
    {
        $this->add_field($name, "password");
        $field_name = strtolower($name);
        $this->$field_name = new Password($name, $this->new_error());
        return ($this);
    }

    /**
    *   Fonction créant une instance du champs select.
    *
    *   @param      string $name
    *   @return     Form_Manager\Field\Select;
    */
    public function add_select($name)
    {
        $this->add_field($name, "select");
        $field_name = strtolower($name);
        $this->$field_name = new Select($name, $this->new_error());
        return ($this);
    }

    /**
    *   Fonction créant une instance du champs submit.
    *
    *   @param      string $name
    *   @return     Form_Manager\Field\Submit;
    */
    public function add_submit($name)
    {
        $this->add_field($name, "submit");
        $field_name = strtolower($name);
        $this->$field_name = new Submit($name, $this->new_error());
        return ($this);
    }

    /**
    *   Fonction créant une instance du champs text.
    *
    *   @param      string $name
    *   @return     Form_Manager\Field\Text;
    */
    public function add_text($name)
    {
        $this->add_field($name, "text");
        $field_name = strtolower($name);
        $this->$field_name = new Text($name, $this->new_error());
        return ($this);
    }

    /**
    *   Fonction créant une instance du champs textarea.
    *
    *   @param      string $name
    *   @return     Form_Manager\Field\Textarea;
    */
    public function add_textarea($name)
    {
        $this->add_field($name, "textarea");
        $field_name = strtolower($name);
        $this->$field_name = new Textarea($name, $this->new_error());
        return ($this);
    }

    /**
    *   Fonction créant une instance d'un champs de type inconnu.
    *
    *   @param      string $name
    *   @return     Form_Manager\Field\Textarea;
    */
    public function add_unknow($name, $type)
    {
        if (in_array($type, ['text', 'password', 'select', 'submit', 'date', 'option']))
        {
            throw new \Exception("There is a specific functionfor this type : "
                                  . $type, 1);
        }
        $field_name = strtolower($name);
        $this->$field_name = new Unknow($name, $type, $this->new_error());
        return ($this);
    }

    /**
    *   Ajoute un attribut au formulaire.
    *
    *   @return Form_Manager
    */
    public function add_attr($attr, $value)
    {
        $this->attr[$attr] = $value;
        return ($this);
    }

    /**
    *   Prépare et affiche le point d'entré du formulaire.
    */
    public function start()
    {
        echo("<form " . $this->attr_to_string() . " >");
    }

    /**
    *   Fonction génerative qui retourne le code HTML de tout les champs de
    *   formulaire renseigné dans cette objet au format HTML.
    *
    *   @return string
    */
    public function get_html()
    {
        $html = "";
        foreach ($this->fields as $key => $value)
            yield($this->$key->get_html());
    }

    /**
    *   Affiche tout les champs du formulaire renseigner dans cette objet au
    *   format HTML.
    */
    public function display()
    {
        foreach ($this->fields as $key => $value)
            $this->$key->display();
    }

    /**
    *   Affiche le point de sortie du formulaire.
    */
    public function end()
    {
        echo("</form>");
    }

    /**
    *   Fonction de vérification enclenché si le mode hard est activé. Les
    *   informations rendu lors de la soumission du formulaire son controllé.
    *   Existe t'il autant de champs envoyé que de champs dans le formulaire.
    *   Les champs sont il dans l'ordre, l'utilisateur à t'il tenté de modifier
    *   le nom des champs.
    *
    *   @return     bool
    */
    private function is_validhard($post)
    {
        $tmp_post = $post;
        $is_valid = TRUE;

        reset($this->fields);
        foreach ($this->fields as $key => $value)
        {
            if (array_key_exists($key, $tmp_post))
            {
                if (strcmp($tmp_post[$key], current($tmp_post)) != 0)
                    $is_valid = FALSE;
            }
            else
                $is_valid = FALSE;
        }
        if (!empty($tmp_post))
            $is_valid = FALSE;
        if ($is_valid == FLASE)
            $this->error->set_active();
        return ($is_valid);
    }

    /**
    *   Fonction de validation d'un formulaire, elle vérifie l'intégrité du
    *   formulaire si le mode hard est enclenché, elle effectue tout
    *   les controles associé au différents champs du formulaire.
    *
    *   @return     bool
    */
    public function is_valid($post, $hard = TRUE)
    {
        $tmp_post = $post;
        $is_valid = TRUE;

        if ($hard == TRUE)
            $is_valid = $this->is_validhard($post);
        if ($is_valid == TRUE)
        {
            reset($this->fields);
            foreach ($this->fields as $key => $value)
            {
                $this->$key->set_attr("value", $tmp_post[$key]);
                if (!$this->$key->is_valid())
                    $is_valid = FALSE;
            }
        }
        return ($is_valid);
    }
}
