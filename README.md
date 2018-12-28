# Form Manager

Form Manager est un gestionnaire de formulaire permettant de générer et d'effectuer des vérifications sur le contenu de celui-ci rapidement. Il est basé sur un système de "gabarit" qui permet de contrôler jusqu'à l'intégrité de celui ci.

___
##### Attention :
> Ce gestionnaire de formulaire est encore en cour de construction, beaucoup de modifications sont à prévoir, la gestion de la rétro compatibilité n'est pas encore prévu. Merci à ce qui l'utiliseront malgré ça.
___

## Les gabarits

Un gabarit est une class qui hérite de la class  abstraite `` Form_Manager\Gabarit() ``, cette classe implémente une méthode abstraite ``load()``, c'est dans cette méthode que nous définirons la structure du formulaire.

Vous devriez également définir un constructeur à votre gabarit, il serait ainsi possible de donner un nom à votre gabarit en appelant le constructeur parent vous pouvez ensuite récupérer le nom de votre gabarit en faisant appel à l'accesseur ``get_name()``.

Un gabarit reste une classe, elle contient donc toutes les possibilités qu'apporte une classe classique. Il n'en reste pas moins que cette classe à pour objectif de centraliser toutes les actions qui serait à effectués autour de ce formulaire.

Voici un exemple concret :

```
<?php

namespace App;

use Form_Manager\Gabarit;

class My_Gabarit extends Gabarit
{
	public function __construct()
	{
		parent::__construct("My_Gabarit");
	}

	public function load()
	{
		// Ici la structure de notre formulaire.
	}
}
```
## Les formulaires

Afin de définir un formulaire, vous pouvez faire appel à l'objet ``$this`` au sein de la méthode ``load()``. L'objet ``$this`` contient de nombreuses méthodes et notamment celle permettant de créer des champs dans mon formulaire.

Nous pouvons accéder à notre champs, en l'appelant simplement pas son nom, en réalité l'objet ``$this`` implémente une méthode magique ``__get()`` qui nous permet d'y accéder aisément. Le nom que l'on peux donner à un champs est insensible à la casse, ``$this`` l’interprétera comme une chaîne de caractère en minuscule.
___
##### Attention :
>Une exception apparaîtra si vous tentez de donner deux fois un même nom à un champs, peu importe la casse que vous donnerez à ces deux nom.
___

Par exemple si je souhaite ajouter un champs de type text au sein de mon formulaire je peux faire comme ceci:

```
public function load()
{
	$this->add_text("Nom"); // Je créer un champs text.
	$this->nom; // J'accède à mon champs de type text appelé nom.

	$this->add_password("mot de passe"); // Je créer un champs password.
	$this->{mot de passe}; // J'accède à mon champs de type password appelé mot de passe.
}
```
L'objet ``$this`` est en réalité une instance de la classe ``Form_Manager\Form_Manager``.

### Définir une action et le type de requête HTTP

Afin de définir l'url cible du formulaire, vous pouvez utiliser la méthode ``set_action("url")``, lorsque vous cliquerez sur le bouton valider, l'action du formulaire sera redirigé vers cette url. Vous pouvez également définir le type de requête HTTP que vous souhaitez en utilisant les méthode ``set_get()`` ou ``set_post()`` l'une annulant l'autre et vis versa.

> Par defaut, le formulaire exécutera une requête HTTP de type GET et sont action cible est ``#``.

### Ajouter une classe au formulaire

Afin d'ajouter des classe au champs de formulaire, vous pouvez utilisez le champs la méthode `` add_class("mes classes css")``.

### Afficher le formulaire.

Il existe plusieurs méthode afin d'obtenir le code HTML qui sera générer grâce au gabarit, la première est ``start()``, celle-ci retourne la balise HTML ouvrante du formulaire. De même il existe la méthode ``end()``, qui retourne la balise HTML fermante du formulaire.

Ainsi le fichier ``.phtml`` suivant:

```
<html>
	<head>
		<title>Form Manager Exemple</exemple>
	</head>
	<body>
		<?php
			require_once("App/My_Gabarit.php"); // Je récupère ma classe de Gabarit
			$form = new My_Gabarit(); // Je créer un instance de mon formulaire.
			$form->load(); // J'initialise mon formulaire.
		?>
		<div id="my_form">
			<?php $form->start(); ?>
			<?php $form->end(); ?>
		</div>
	</body>
<html>
```
Devrait produire sur le navigateur, le résultat suivant:
```
<html>
	<head>
		<title>Form Manager Exemple</exemple>
	</head>
	<body>
		<div id="my_form">
			<form action="#" methode="get">
			</form>
		</div>
	</body>
<html>
```
Il existe également la méthode ``get_html()`` qui retourne l'intégralité du code HTML produite par le formulaire dans une chaîne de caractère, et la méthode ``display()`` qui affiche l'intégralité du formulaire. Mais c'est méthodes manque de malléabilité, il est préférable d'utilisé les méthode d'affichages spécifique à chacun des champs.

### Vérifier un formulaire.

Afin de vérifier un formulaire il suffit d'utilise la méthode ``is_valid()`` après avoir charger le formulaire. C'est grâce à cette architecture ce basant sur un système de gabarit, qu'il est possible de vérifier à la fois le contenu et également la structure de celui-ci.

Par exemple:
```
public function controller_check_form()
{
	$form = new My_Gabarit(); // Nouvelle instance de mon gabarit.
	$form->load(); // Chargement de mon gabarit
	if (isset($_POST))
		$form->is_valid($_POST); // Vérification du formulaire, si une erreur existe sauvegarde de l'erreur.
	return ($form);
}
```

### La gestion des erreurs pour un formulaire.

Il est possible d'ajouter un message d'erreur au formulaire en tant que tel, c'est à dire qu'il peux exister des cas ou le formulaire et sa structure peux posé problème par exemple si l'utilisateur tente d'envoyer le formulaire en supprimant un des champs qu'il le compose. Il vous est possible d'éditer ce message d'erreur en utilisant la méthode ``set_error()``.

par défaut le message d'erreur est: ``To edit this message you can use set_error() function or remove it with the unset_error() function.``

Comme indiqué dans le message d'erreur par défaut si dessus, si vous souhaitez supprimer le message d'erreur vous pouvez utiliser la méthode ``unset_error()``.

Vous pouvez récupérer le message d'erreur via les méthodes ``get_error()`` qui retourne l'erreur sous la forme d'une chaîne de caractère ou via ``display_error()`` qui affiche directement le message d'erreur.

___
##### Attention :
> Il est certain que cette section évolue, la gestion des erreurs n’étant pas très avancé.
___

## Les champs de formulaire

Les champs de formulaire sont une instance de la classe ``Form_Manager\Field_Manager``. Ces champs possède un ensemble de méthode commune mais parfois certaine des ces méthodes on un comportement particulier en fonction de type de champs.

Comme vu précédemment pour créer un champs de formulaire il suffit des faire appel à une des méthode de création d'un champs, puis d'y accéder via le nom de ce champs. La gestion des champs de ce gestionnaire de formulaire implémente de nombreuses fonctionnalité, allant de la création d'attribut, au contrôles de tout type jusqu'à l'implémentation de regex spécifique pour chacun des champs.

### Ajouter un classe au champs

Comme pour le formulaire, il existe une méthode ``add_class("mes classes")``, cette méthode permet d'ajouter un attribut de type classe au champs.

### Ajouter des attributs au champs

Il est possible d'ajouter n'importe quel type d'attribut au champs, qu'il soit un attribut reconnue ou non. Vous pouvez le faire via la méthode ``add_attr($name, $value = NULL)``.  Si value vaut NULL il n'y aura aucune valeur associé au nom de l'attribut.
___
##### Attention :
>Cette méthode peut générer une exception suivant si l'attribut existe déjà ou non. Si l'attribut existe déjà, il vous sera demandé d'utiliser le mutateur ``set_attr($name, $value = NULL)``.
___

Il est possible de modifier la valeur d'un attribut en utilisant la méthode ``set_attr($name, $value = NULL)``, le comportement est identique à la méthode ``add_attr($name, $value = NULL)`` seulement il modifie un attribut existant plutôt que de le créer.

___
##### Attention :
>Une exception sera levé si vous tentez de modifier un attribut inexistant.
Une exception sera levé si vous tentez de modifier les attributs ``type`` et ``name``, qui sont des champs réservé.
___

L'ordre des attributs en HTML possède le même ordre que celui lors de leurs créations.

>Il n'est pas possible d'éditer les attributs ``type`` et ``name``, vous pouvez cependant en créer des personnalisés en utilisant la méthode add_unknow($name, $type); attention ce champs possédera le comportement d'un champs par défaut.

### Afficher un champs

Il existe deux méthodes afin de récupérer le code HTML générer pour le champs. La méthode ``get_html()`` retourne une chaîne de caractères contenant le code HTML spécifique au champs. La méthode ``display()`` affiche directement le code HTML du champs.

Reprenons l'exemple d'affichage précédent.
Ce fichier ``.phtml`` suivant:
```
<html>
	<head>
		<title>Form Manager Exemple</exemple>
	</head>
	<body>
		<?php
			require_once("App/My_Gabarit.php"); // Je récupère ma classe de Gabarit
			$form = new My_Gabarit(); // Je créer un instance de mon formulaire.
			$form->load(); // J'initialise mon formulaire.
		?>
		<div id="my_form">
			<?php $form->start(); ?>
				<?php $form->pseudo->display() ?>
				<?php $form->password->display() ?>
				<?php $form->valider->display() ?>
			<?php $form->end(); ?>
		</div>
	</body>
<html>
```
Devrait produire sur le navigateur, le résultat suivant:
```
<html>
	<head>
		<title>Form Manager Exemple</exemple>
	</head>
	<body>
		<div id="my_form">
			<form action="/" methode="post">
				<input type="text" name="pseudo" />
				<input type="password" name="password" />
				<input type="submit" name="valider" value="valider />
			</form>
		</div>
	</body>
<html>
```
Le gabarit associé est le suivant:
```
class My_Gabarit extends Gabarit
{
	public function __construct()
	{
		parent::__construct("My_Gabarit");
	}

	public function load()
	{
		$this->set_action("/");
		$this->set_post();
		$this->add_text("pseudo");
		$this->add_password("password");
		$this->add_submit("valider");
	}
}
```

### Spécifier un message d'erreur pour le champs.
...
### Ajouter des contrôles

Afin d'ajouter des contrôles au champs, il faut utiliser la méthode ``add_control($control, $args = [])`` cette méthode prends en paramètre le nom du contrôle et un tableau d'arguments le nombre d'élément dans ce tableau peu varié en fonction du type de contrôle demandé.

Si vous faite un appel à la méthode ``set_error()`` juste après la création du contrôle, vous pouvez spécifier le message d'erreur pour ce contrôle pour ce champs spécifiquement. Le design paterne ``fluent``  est largement exploité ici.

Dans l'exemple ci dessous, nous créons un champs type ``text`` ayant pour nom ``pseudo``, nous indiquons que le champs est requis avec le contrôle ``require`` et définissons une erreur  à retourner dans le cas où le champs resterai vide lors de l'envois du formulaire.

```
public function load()
{
	$this->add_text("pseudo");
	$this->pseudo->add_control("require")
				 ->set_error("Ce champs est requis");
}
```

### Ajouter des regex
...
### Spécifier des messages d'erreurs au contrôle et au regex.
...
### Vérifier le champs

Il n'existe pas de méthode spécifique pour contrôler le champs indépendamment du formulaire. Afin de contrôler la validité du champs, il suffit de passer par le méthode ``is_valid()`` du formulaire.

### Quelques méthode supplémentaires
...
## Liste des champs de formulaire

 - Date =>  ``add_date($name);``
 - Option => ``add_option($value);``
 - Password => ``add_password($name);``
 - Select => ``add_select($name);``
 - Submit => ``add_submit($name);``
 - Text => ``add_text($name);``
 - Unknow => ``add_unknow($name, $type);``

#### Date

Afin d'ajouter un champs de type date, vous pouvez faire appel à la méthode, ``add_date($name)``.  Cette méthode prends en paramètre  un nom.

```
public function load()
{
	$this->add_date("debut");
}
```
#### Option

Afin d'ajouter un champs de type option, vous pouvez faire appel à la méthode, ``add_option($value)``, Cette méthode prends en paramètre  un nom, ce nom correspond également à la valeur. Il n'y à que peux de cas où ce champs serait définit seul, il est le plus souvent associé à un autre type de champs.

```
public function load()
{
	$this->add_option("1");
}
```

#### Password

Afin d'ajouter un champs de type password, vous pouvez faire appel à la méthode, ``add_password($name)``.  Cette méthode prends en paramètre un nom.

```
public function load()
{
	$this->add_password("mot de passe");
}
```
#### Select

Afin d'ajouter un champs de type date, vous pouvez faire appel à la méthode, ``add_select($name)``.  Cette méthode prends en paramètre  un nom.

```
public function load()
{
	$this->add_select("selection");
}
```
#### Submit

Afin d'ajouter un champs de type submit, vous pouvez faire appel à la méthode, ``add_submit($name)``.  Cette méthode prends en paramètre  un nom.

```
public function load()
{
	$this->add_submit("valider");
}
```
#### Text

Afin d'ajouter un champs de type text, vous pouvez faire appel à la méthode, ``add_text($name)``.  Cette méthode prends en paramètre  un nom.

```
public function load()
{
	$this->add_text("text");
}
```
#### Unknow

Afin d'ajouter un champs de type date, vous pouvez faire appel à la méthode, ``add_unknow($name, $type)``.  Cette méthode prends en paramètre, un nom et un type de champs qui ne serait pas présent dans ce formulaire.
```
public function load()
{
	$this->add_select("blanck", "unknow");
}
```


## Liste des contrôles champs existants

 - Interval
 - Require
 - Max
 - Min

## Liste des regex de champs existantes

 - Alpha
 - Mail
 - Specific
