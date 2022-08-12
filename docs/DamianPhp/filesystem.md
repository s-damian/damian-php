# Core\Filesystem\FileUpload;

```php
<?php

// Uploader un fichier :
// (seul le 1er paramètre est obligatoire)
$fileUpload = new FileUpload('upload_path', 'attr_name_file', ['prefix_name'=>'prefix_du_nom_du_fichier_a_uploader']);

if ($fileUpload->move()) {
    $this->image = $fileUpload->getName();
}

// return string|array - Nom du fichié(s) uploadé(s).
$fileUpload->getName();


// Supprimer un fichier :
$fileUpload = new FileUpload('upload_path');

$fileUpload->remove('name_file_a_supprimer');
```
