<?php
use DamianPhp\Support\Facades\Security;
$baliseTitle = 'Error 404';
$metaRobotsNoIndex = true;
?>
<section>
    <h1 itemprop="name" class="h1"><?php echo Security::e($title); ?></h1>
    <p>Error 404 - Page not found</p>
</section>