<?php
header('Content-type: text/xml; charset='.config('app.charset'));
echo '<?xml version="1.0" encoding="'.config('app.charset').'"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    echo $viewInLayout; // Vue
echo '</urlset>';