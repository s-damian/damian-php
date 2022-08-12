## * Sommaire *

* Config
* Lang
* Trans




# Config

Les fichiers de config se trouvent dans le répertoire "/config".
Dans ce répertoire, on peut créer des nouveaux fichiers, mais on ne peut pas créer des sous-dossiers.
On peut aussi créer des tableaux multi-dimensionels.

- Syntaxes possibles :

```php
<?php

config('app')['debug'];
config('app.debug');
```



# Lang

Les fichiers de lang (tranduction du framework) se trouvent dans le répertoire "/render/lang/xx/*".
Dans ce répertoire, on peut créer des nouveaux fichiers, mais on ne peut pas créer des sous-dossiers.
On peut aussi créer des tableaux multi-dimensionels.

- Syntaxes possibles :

```php
<?php

lang('pagination')['next'];
lang('pagination.next');
```



# Trans

Les fichiers de trans (tranduction du site web) se trouvent dans le répertoire "/render/trans/xx/*".
Dans ce répertoire, on peut créer des nouveaux fichiers et des nouveaux sous-dossiers.
On ne peut pas créer des tableaux multi-dimensionels.


- Syntaxes possibles :

```php
<?php

trans('layout')['alt_logo'];
// Dans cette exemple, le fichier "403" est dans le sous-dossier "error"
trans('error/403')['h1']

trans('layout.alt_logo');
// Dans cette exemple, le fichier "403" est dans le sous-dossier "error"
trans('error.403.h1')
```

L'avantage de la 2ème syntaxe, est que si une key ("h1" dans cet exemple) n'existe pas dans un fichier, ça renverra null.
