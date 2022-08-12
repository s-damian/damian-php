<?php
use DamianPhp\Support\Facades\Security;
$baliseTitle = $title;
?>
<section>
    <h1 itemprop="name" class="h1"><?php echo Security::e($title); ?></h1>
    <p>Article with slug "<?php echo Security::e($slug); ?>"</p>
</section>