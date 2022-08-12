<?php
header('Content-type: text/html; charset='.config('app.charset'));
use DamianPhp\Support\Facades\Security;
use DamianPhp\Support\Facades\Media;
use DamianPhp\Support\String\Lang;
$htmlLangCountry = Lang::hasCountryLanguage(getLocale()) ? '-'.Lang::getCountryLanguage(getLocale()) : '';
?>
<!DOCTYPE html>
<html class="not-ie no-js" lang="<?php echo getLocale().$htmlLangCountry; ?>">
<head>
    <meta charset="<?php echo config('app.charset'); ?>">
    <title><?php echo Security::e($baliseTitle); ?></title>
    <?php if (isset($metaRobotsNoIndex)) { ?>
        <meta name="robots" content="noindex, nofollow">
    <?php } ?>
    <meta name="description" content="Damian PHP Framework">
    <link rel="shortcut icon" href="/favicon.ico">
    <?php echo Media::getCssWithV('assets/app.css'); ?>
    <?php
    if (isMultilingual()) {
        if (!defined('NO_HREFLANG')) {
            Lang::addHreflang();
            echo Lang::getHreflang();
        }
    }
    ?>
</head>
<body>
    <?php echo $viewInLayout; // Vue ?>

    <?php echo Media::getJsWithV('assets/app.js'); ?>
</body>
</html>