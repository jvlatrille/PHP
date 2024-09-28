<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="Form1" content="width=device-width, initial-scale=1.0">
    <title>Form1</title>
</head>

<body>
    <?php

    /* Question 1 */
    $fichierConfig = fopen("config.ini", "r");
    $valeursConfig = [];

    // Récupération des lignes du fichier config.ini
    while (!feof($fichierConfig)) {
        $ligne = fgets($fichierConfig, 255);
        if ($ligne[0] != '[') {
            array_push($valeursConfig, $ligne);
        }
    }
    fclose($fichierConfig); // Toujours fermer le fichier
    

    // Nom du fichier PHP à générer
    $nomFichierPhp = trim($valeursConfig[0]) . '.php';
    $nombreChamps = (int) $valeursConfig[1];

    // Création du fichier HTML avec le formulaire
    $fichierHtml = fopen(trim($valeursConfig[0]) . '.html', 'w+');
    $formulaireHtml = "<form id='idForm' action='$nomFichierPhp' method='POST'> <br>";
    fwrite($fichierHtml, $formulaireHtml);

    // Boucle pour générer les champs du formulaire
    for ($i = 0; $i < $nombreChamps; $i++) {
        $nomChamp = trim($valeursConfig[$i + 2]);
        $formulaireHtml = "<input name='{$nomChamp}' id='{$nomChamp}' placeholder='Entrez votre : {$nomChamp}'> <br>";
        fwrite($fichierHtml, $formulaireHtml);
    }

    // Bouton de validation du formulaire
    $formulaireHtml = '<button type="submit">Valider</button> <br>';
    fwrite($fichierHtml, $formulaireHtml);
    $formulaireHtml = '</form>';
    fwrite($fichierHtml, $formulaireHtml);

    fclose($fichierHtml); // Toujours fermer le fichier
    
    
    /* Question 2 */

    // Génération du fichier PHP pour traiter les données du formulaire
    $fichierPhp = fopen($nomFichierPhp, 'w+');
    $contenuPhp = "<?php\n";
    $contenuPhp .= "if (\$_SERVER['REQUEST_METHOD'] == 'POST') {\n";

    // Boucle pour récupérer et afficher les valeurs des champs du formulaire
    for ($i = 0; $i < $nombreChamps; $i++) {
        $nomChamp = trim($valeursConfig[$i + 2]);
        $contenuPhp .= "    \$${nomChamp} = isset(\$_POST['${nomChamp}']) ? htmlspecialchars(\$_POST['${nomChamp}']) : 'Non renseigné';\n";
        $contenuPhp .= "    echo '${nomChamp}: ' . \$${nomChamp} . '<br>';\n";
    }

    // Gestion des erreurs si aucune donnée n'a été soumise
    $contenuPhp .= "} else {\n";
    $contenuPhp .= "    echo 'Aucune donnée soumise.';\n";
    $contenuPhp .= "}\n";
    $contenuPhp .= "?>";

    fwrite($fichierPhp, $contenuPhp); // Écriture du contenu PHP
    fclose($fichierPhp); // Toujours fermer le fichier
    ?>
</body>

</html>