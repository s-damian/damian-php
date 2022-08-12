# use DamianPhp\Support\Facades\Hash;

```php
<?php

// Hasher un password
Hash::hash($password);

// Verifier le password soumis depuis un formulaire
if (Hash::verify($this->password, $result->password)) {
    // ok...
}

// return bool - Vérifiez si le hachage donné a été haché en utilisant les options données
Hash::needsRehash(string $hashedValue);
```
