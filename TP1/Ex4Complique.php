<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP1 - Ex4</title>
</head>

<body>
    <?php
    // On désire réaliser un compteur de visites dans une page d’accueil.
    // Parcours unique du fichier contenant le compteur
    $visites = 0;
    echo "Nombre de visites initialisé : $visites <br>";   
    $visites = (int) file_get_contents('compteur.txt');
    $visites++;
    file_put_contents('compteur.txt', $visites);
    echo "Nombre de visites : $visites";
    ?>

</body>

</html>
