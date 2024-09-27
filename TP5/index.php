<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="Form1" content="width=device-width, initial-scale=1.0">
    <title>Form1</title>
</head>

<body>
    <?php
    $monFichier = fopen("config.ini", "r");
    $tabNouvellesValeurs = [];

    while (!(feof($monFichier))) {
        $ligne = fgets($monFichier, 255);
        if ($ligne[0] != '[') {
            array_push($tabNouvellesValeurs, $ligne);
            echo $ligne . "<br>";
        }
    }
    fclose($monFichier);

    $newFile = $tabNouvellesValeurs[0];
    $newFile = trim($newFile) . '.html';
    echo $newFile . '<br>';

    $nombreDonnees = (int) $tabNouvellesValeurs[1];
    echo $nombreDonnees . '<br>';


    $open = fopen($newFile, 'w+');

    $pageHtml = '<form id="idForm"> <br>';
    fwrite($open, $pageHtml);
    for ($i = 0; $i < $nombreDonnees; $i++) {
        $val = $tabNouvellesValeurs[$i + 2];
        $pageHtml = "<input id='{$val}' placeholder='Entrez votre : {$val}'> <br>";
        fwrite($open, $pageHtml);
    }
    $pageHtml = '<button type="submit">Valider</button> <br>';
    fwrite($open, $pageHtml);
    $pageHtml = '</form>';
    fwrite($open, $pageHtml);

    fclose($open);
    ?>
</body>

</html>