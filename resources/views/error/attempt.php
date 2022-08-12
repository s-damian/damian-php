<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="<?php echo config('app.charset'); ?>">
        <title>Nombre de tentatives dépassée</title>
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            html, body, h1, h2 {
                margin: 0;
                padding: 0;
                
            }

            html {
                font-size: 100%;
                height: 100%;
            }

            body {
                font-size: 16px;
                height: 100%;
                color: #687881;
                text-align: center;
            }

            h1 {
                font-size: 2.2em;
                line-height: 1.5em;
                margin-top: 120px;
            }
        </style>
    </head>
    <body>
        <h1>Nombre de tentatives dépassée</h1>
        <p>Nombre de tentatives dépassée. Vous aller être bannis pour une durée total de "<?php echo $durationBlocking; ?>" minutes.</p>
    </body>
</html>