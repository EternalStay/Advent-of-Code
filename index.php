<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advent of Code</title>
    <style>
    
    </style>
</head>
<body>
<?php
$repertoireCourant = __DIR__;

$annees = array_filter(glob($repertoireCourant . '/*'), 'is_dir');
foreach ($annees as $annee) {
    echo '<h1>Année '.basename($annee).'</h1>';

    $jours = array_filter(glob($annee . '/*'), 'is_dir');
    echo '<ul>';
    foreach ($jours as $jour) {
        echo '<li>';
        echo 'Jour '.basename($jour).' : ';

        $files = array_filter(glob($jour . '/*.php'), 'is_file');

        $text = [];
        foreach ($files as $file) {
            $relativePath = str_replace($repertoireCourant, '', $file);
            $relativePath = ltrim($relativePath, '/');
            $text[] = '<a href="'.$relativePath.'">Partie '.basename(str_replace('.php', '', $file)).'</a>';
        }

        echo implode(' et ', $text);

        echo '</li>';
    }
    echo '</ul>';
    
}
?>

</body>
</html>
