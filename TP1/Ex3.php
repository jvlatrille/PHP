<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP1 - Ex3</title>
</head>

<body>
    <?php
    $file = fopen('restos.csv', 'r');
    
    while (!feof($file)) {
        $line = fgets($file);
        $data = explode(';', $line);
    
        $nom = ($data[0]);
        $prenom = ($data[1]);
        $restaurant = ($data[2]);

        echo "Nom : $nom <br> Prénom : $prenom <br> Restaurant : $restaurant <br> <hr>";
    }

    fclose($file);
    ?>

</body>

</html>