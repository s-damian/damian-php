<?php
use DamianPhp\Support\Facades\Security;
$baliseTitle = $title;
?>
<section>
    <h1 itemprop="name" class="h1"><?php echo Security::e($title); ?></h1>
    <p>List of articles</p>
</section>