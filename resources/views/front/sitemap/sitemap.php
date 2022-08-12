<?php
foreach ($articles as $article) {
    ?>
    <url>
        <loc><?php echo route('article_show', ['slug'=>$article->slug]); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php
}
?>