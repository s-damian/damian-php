# use DamianPhp\Validation\Validator;

## Méthodes

| Static ? Type de retour | Nom | Description |
| ------- | -------------- | ----------- |
| static void | extend(string $rule, callable $callable, string $message) | Pour ajouter une règle dee validation |
| void | __construct($requestMethod = null) | Constructeur |
| void | specifyMessageErrors(array $messages) | Spécifier message |
| void | rules(array $inputsWithRules) | Active le validateur |
| bool | isValid() | True si formulaire soumis est valide |
| string | getErrors() | Tableau associatif des erreurs |
| string | getErrorsHtml() | Les erreurs à afficher au format HTML |
| string | getErrorsJson() | Les erreurs à afficher au format JSON |
| bool | hasError('input_name') | True si un input à une erreur |
| string | getError('input_name') | Erreur(s) de l'input |




## Règles de validations disponibles

* 'alpha' => bool
* 'alpha_numeric' => bool
* 'between' => array (2 valeurs : valeur min, valeur max)
* 'confirm' => array (les 2 valeurs à vérifier)
* 'empty' => bool
* 'format_date' => bool
* 'format_date_time' => bool
* 'format_email' => bool
* 'format_ip' => bool
* 'format_name_file'
* 'format_postal_code' => bool
* 'format_slug' => bool
* 'format_tel' =>bool
* 'format_url' => bool
* 'integer' => bool
* 'in_array' => array
* 'max' => int
* 'min' => int
* 'no_regex'=> string (regex qui ne doit pas matcher)
* 'not_in_array' => array
* 'regex'=> string (regex qui doit matcher)
* 'required' => bool

Pour les "format_*", le format sera vérifier uniquement si une valeur est soumise.
Faut donc penser à ajouter aux règles du champ un 'required' si on veut que interdire la valeur vide.




## Comment faire ?

* Il faut d'abord instancier le Validateur.
* Il faut ensuite lui passez lui des règles de validation.
* Il faut ensuite vérifiez si le formulaire soumis est valide en fonction des règles définis.
* On peut ensuite renvoyer la réponse au format HTML ou au format JSON.




## Exemple

### Code PHP (avec pour exemple toutes les règles de validations disponibles dans ma méthode "rules")

```php
<?php

use DamianPhpValidator\Validator;

if (Request::isPost()) {
    // Instancier le Validateur
    $validator = new Validator();

    //$validator = new Validator($_GET);  // optionel - pour method GET au lieu de POST

    // optionel - doit être avant la méthode rules dans le script
    $validator->specifyMessageErrors([
        'alloemail' => ['empty' => 'Une erreur est survenue, merci de me contacter par téléphone.'],
    ]);
    
    // Ajouter règle(s) de validation pour les inputs
    $validator->rules([
        'alpha' => [
             'alpha' => true
        ],
        'alpha_numeric' => [
            'label' => 'Alpha numerique',
            'alpha_numeric' => true
        ],
        'between' => [
            'between' => [2, 9]
        ],
        'password' => [
            'label' => 'Mot de passe',
            'confirm' => [$_POST['password'], $_POST['password_confirmation']]
        ],
        'empty' => [
            'empty' => true
        ],
        'date' => [
            'format_date' => true,
        ],
        'date_time' => [
            'format_date_time' => true,
        ],
        'email' => [
            'format_email' => true,
        ],
        'ip' => [
            'format_ip' => true,
        ],
        'name_file' => [
            'label' => 'Nom du fichier',
            'format_name_file' => true
        ],
        'postal_code' => [
            'format_postal_code' => true
        ],
        'slug' => [
            'format_slug' => true,     
        ],
        'tel' => [
            'format_tel' => true,     
        ],
        'url' => [
            'format_url' => true,     
        ],
        'integer' => [
            'integer' => true,     
        ],
        'in_array' => [
            'in_array' => [1, 2, 3],     
        ],
        'max' => [
            'max' => 10,     
        ],
        'min' => [
            'min' => 5,     
        ],
        'no_regex' => [
            'no_regex' => "#^[0-9]+$#",    
        ],
        'regex' => [
            'regex' => "#^[a-z]+$#",    
        ],
        'required' => [
            'label' => 'Requis',
            'required' => true,     
        ],
    ]);
    
    // Vérifier si le formulaire est valide
    if ($validator->isValid()) {
        // Success
    } else {
        // Récupérer toutes les erreurs :
        var_dump($validator->getErrors()); // return array
        var_dump($validator->getErrorsHtml()); // return string
        var_dump($validator->getErrorsJson()); // return string
    }
}
```



### Code HTML (exemple de formulaire pour tester le code PHP de ci-dessus)

```html

<form action="#" method="post">
    <label>Alpha :</label>
    <input type="text" name="alpha"><br>

    <label>Alpha numerique :</label>
    <input type="text" name="alpha_numeric"><br>

    <label>Between :</label>
    <input type="text" name="between"><br>

    <label>Mot de passe :</label>
    <input type="password" name="password"><br>

    <label>Confirmamtion du Mot de passe :</label>
    <input type="password_confirmation" name="password_confirmation"><br>

    <label>Empty :</label>
    <input type="empty" name="empty"><br>

    <label>Date :</label>
    <input type="date" name="date"><br>

    <label>Date time :</label>
    <input type="date_time" name="date_time"><br>

    <label>Email :</label>
    <input type="email" name="email"><br>

    <label>IP :</label>
    <input type="ip" name="ip"><br>

    <label>Nom du fichier :</label>
    <input type="name_file" name="name_file"><br>

    <label>Code postale :</label>
    <input type="postal_code" name="postal_code"><br>

    <label>Slug :</label>
    <input type="text" name="slug"><br>

    <label>TEL :</label>
    <input type="text" name="tel"><br>

    <label>URL:</label>
    <input type="text" name="url"><br>
    
    <label>Integer :</label>
    <input type="text" name="integer"><br>

    <label>In array :</label>
    <select name="in_array">
        <option value="0">Choisir...</option>
        <option value="1">Choix 1</option>
        <option value="2">Choix 2</option>
        <option value="3">Choix 3</option>
    </select><br>

    <label>Max :</label>
    <input type="text" name="max"><br>

    <label>Min :</label>
    <input type="text" name="min"><br>

    <label>No regex :</label>
    <input type="text" name="no_regex"><br>

    <label>Regex :</label>
    <input type="text" name="regex"><br>

    <label>Requis :</label>
    <input type="text" name="required"><br>

    <input type="submit" value="Envoyer">
</form>
```




## Description de la méthode "rules"

En paramètre de la méthode "rules" on doit y passer un array associatif.
Les keys (string) de ce array associatif doivent êtres les name des inputs.
Les values (array) de ce array associatif doivent êtres les règles que l'on spécifie à cette input.
```php
<?php

use DamianPhpValidator\Validator;

if (Request::isPost()) {
    $validator = new Validator();

    $validator->rules([
        'input_name_1' => $arrayRulesInput1,
        'input_name_2' => $arrayRulesInput2,
    ]);

    var_dump($validator->isValid());    // return bool
}
```




## Ajouter des règles de validation personnalisées

Si vous souhaitez ajouter une règle de validation, il faut utiliser la méthode "extend" avant la méthodes "rules".
Exemple :

```php
<?php

use DamianPhpValidator\Validator;

// Ajouter une nouvelle règle de validation.
// $input sera le name de l'input.
// $value sera la valeur soumise de l'input.
// $parameters sera sa valeur spécifiée à la règle de validation au 'rule_name' à un 'name_input' dans la method "rules".
Validator::extend('rule_name', function ($input, $value, $parameters) {
    return $value == $parameters; // retournez votre condition pour retourner un booléen
});
    
if (Request::isPost()) {
    $validator = new Validator();
    
    // ajouter règle(s) de validation pour les inputs
    $validator->rules([
        // ajouter la règle de validation que vous venez de créer pour le input
        'input_name' => ['rule_name'=>'value_to_rules'],
    ]);
}
```




## Pour éventuellement ajouter une erreur à la volé selon un traitement

```php
<?php

if ($condition === false) {
     $validator->addError('Votre message d\'erreur personnalisé...');
}
```




## Vérifier si une erreur spécifique existe

```php
<?php

if ($validator->hasError('input_name')) {
    var_dump($validator->getError('input_name')); // return string
}
```




## Réponses

Voici les méthodes disponibles pour obtenir les réponses :
```php
<?php

if ($validator->isValid()) {
    // Méthodes disponible uniquement si le formulaire est valide :

    echo $validator->getSuccess();
} else {
    // Méthodes disponible uniquement si le formulaire n'est pas valide :

    var_dump($validator->getErrors()); // return array

    echo $validator->getErrorsHtml();

    echo $validator->getErrorsJson();
}

// Méthodes disponibles peu importe si le formulaire est valide ou non :

echo $validator->getMessages()->toHtml();
// revient au même que :
echo $validator->getMessages();

echo $validator->getMessages()->toJson();
```
