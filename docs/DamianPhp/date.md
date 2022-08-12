# use DamianPhp\Support\Facades\Date;

```php
<?php

// # Utiliser la Facade :
// return string - DateTime...
echo Date::getDateTimeFormat($formatOptional);

// # Ou le faire avec une instance :
use DamianPhp\Date\Date;

// Instancier :
$date = new Date();

// Modifier la timezone :
$date->setTimeZoneForDateTimeZone($timeZone);

// return string -  DateTime...
$date->getDateTimeFormat($formatOptional);
```
