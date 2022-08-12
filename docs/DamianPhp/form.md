# use DamianPhp\Support\Facades\Form;

```php
<?php

// Les array d'options sont OPTIONAL pour tous.
// Avec les input et textarea, si on ne met pas d'id en options, le id sera le name.
// Pour les input, textarea, select : Les données sont conservées dans les champs si request is post (utile si erreur(s)).


// Ouvrir un formaulaire
echo Form::open(['action' => route('edit', $id), 'method' => 'put', 'class' => 'form-edit', 'files' => true]);


echo Form::label('for', 'Text :', ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;']);


echo Form::text('name', $value, ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;', 'placeholder'=>'Placeholder', 'required'=>true]);

echo Form::email('name', $value, ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;', 'placeholder'=>'Placeholder', 'required'=>true]);

echo Form::search('namesearch', $value, ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;', 'placeholder'=>'Placeholder', 'required'=>true]);

echo Form::url('name', $value, ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;', 'placeholder'=>'Placeholder', 'required'=>true]);

echo Form::tel('name', $value, ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;', 'placeholder'=>'Placeholder', 'required'=>true]);

echo Form::password('name', ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;', 'placeholder'=>'Placeholder', 'required'=>true]);

echo Form::hidden('name', $value, ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;']);

echo Form::checkbox('name', $value, ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;', 'checked'=>true]);

echo Form::radio('name', $value, ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;', 'checked'=>true]);

echo Form::number('name', $value, ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;', 'step'=>"2", 'min'=>10, 'max'=>260]);

echo Form::range('name', $value,  ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;', 'step'=>"2", 'min'=>10, 'max'=>260]);


echo Form::submit('name', 'Envoyer', ['id'=>'idsubmit', 'style'=>'margin-bottom: 20px;']);


echo Form::file('namefile', ['id'=>'idfile', 'class'=>'classfile', 'style'=>'margin-bottom: 20px;',]);
echo Form::file('namefiles[]', ['id'=>'idfile', 'class'=>'classfile', 'style'=>'margin-bottom: 20px;', 'multiple'=>true]);


echo Form::button('Text Button', ['name'=>'Envoyer', 'style'=>'margin-bottom: 20px;']);


echo Form::textarea('name', $value, ['id'=>'id-css', 'class'=>'class-css', 'style'=>'margin-bottom: 20px;', 'placeholder'=>'Ecrivez...', 'required'=>true]);


// Génère un <select> avec ses <option>
// (en 3ème paramètres, le selectedPerDefault OPTIONAL)
echo Form::select('name', [
    1=>'Publié',
    2=>'Brouillon',
    3=>'Corbeille',
], 2, [
    'class'=>'classselect',
    'id'=>'idselect',
    'autosubmit'=>'idform',
    'style'=>'margin-bottom: 20px;',
]);

// Génère un <select> avec des group <optgroup> et ses <option>
echo Form::select('nameselect', [
    'articles'=>[
        1=>'Publié',
        2=>'Brouillon',
        3=>'Corbeille',
    ],
    'pages'=>[
        4=>'Publié',
        5=>'Brouillon',
        6=>'Corbeille',
    ],
], 2, [
    'class'=>'classselect',
    'id'=>'idselect',
]);


// Fermer formulaire
echo Form::close();
```
