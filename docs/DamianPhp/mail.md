# use DamianPhp\Mail\Mailer;

```php
<?php

$mailer = new Mailer();
$mailer->setFrom([$this->email, $this->first_name.' '.$this->name])
    ->setReplyTo($this->email) // OPTIONEL
    ->setTo(string $mail_to)
    ->setSubject(string $subject)
    ->attach(string $this->pathToFile) // OPTIONEL
    ->setBody(string $pathHtml, array $data); // $data est OPTIONEL
    ->addBodyText(string $pathText', array $data); // OPTIONEL
if ($mailer->send()) {
    // Success
} else {
    // Error
}
```



A la méthode setFrom(), si on veut lui soumettre Email + Nom de celui qui envoi le mail, faire comme ceci :
```php
<?php

$mailer->setFrom(['mail@gmail.com', 'Prénom Nom']);
```

Si on veut lui soumettre que son adresse mail, faire comme ceci :
```php
<?php

$mailer->setFrom('mail@gmail.com');
```





A la méthode setTo(), si on veut lui soumettre plusieures adresses mail destinataires (plusieurs receveurs) :
```php
<?php

$mailer->setFrom('mail@gmail.com', 'mail2@gmail.com', 'mail3@gmail.com');
```