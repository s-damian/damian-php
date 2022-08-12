# use DamianPhp\Support\Facades\Log;

```php
<?php

// Envoyer un log d'information (pour les fichiers qui sont dans le dossier "app")
Log::infoApp(__FILE__. '('.__LINE__.') - Message : Info...', 'file_specifique_optional');
// irons se logget dans storage/logs/default/infos.log

// Envoyer un log d'erreur (pour les fichiers qui sont dans le dossier "app"). (tous les fichiers appelés ainsi que les lines, seront précisés automatiquement)
Log::errorApp('Erreur...', 'file_specifique_optional');
// irons se logget dans storage/logs/default/errors.log

// Envoyer un log d'erreur (pour les fichiers qui sont dans le dossier "DamianPhp"). (tous les fichiers appelés ainsi que les lines, seront précisés automatiquement)
Log::errorDamianPhp('Erreur...');
// irons se logget dans storage/logs/errors-damian-php.log
```
