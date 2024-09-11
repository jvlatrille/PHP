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
    // Simple avec ouverture 2 fois du fichier contenant le compteur
    $visites = 0;
    echo "Nombre de visites initialisé : $visites <br>";   
    $compteur = fopen('compteur.txt', 'r+');
    $visites = fgets($compteur);
    echo "Nombre de visites récupéré : $visites <br>";   
    $visites++;
    fseek($compteur, 0);
    fputs($compteur, $visites);
    echo "Nombre de visites à la fin: $visites";    

    ?>

</body>

</html>