<?php
// Générer un formulaire HTML
// Lire le fichier de configuration
$config = parse_ini_file('config.ini', true);

// Récupérer les valeurs du fichier config.ini
$nom_fichier = $config['NOMFIC']; // Nom du fichier HTML
$nb_champs = $config['NB'];
$noms_champs = $config['NOMS'];

// Générer le contenu du fichier HTML
$formulaire_html = "<form id='idForm' action='" . $nom_fichier . ".php' method='POST'>\n";

foreach ($noms_champs as $nom) {
    $formulaire_html .= "<br><input name='$nom' id='$nom' placeholder='Entrez votre : $nom'>\n";
}

$formulaire_html .= "<br><button type='submit'>Valider</button>\n";
$formulaire_html .= "</form>\n";

// Écrire le contenu dans le fichier HTML (Form1.html)
file_put_contents($nom_fichier . '.html', $formulaire_html);

// Confirmation que le fichier HTML a été généré
echo "Le fichier $nom_fichier.html a été généré avec succès.";
?>


<?php
// Générer le script PHP de traitement
// Lire le fichier de configuration
$config = parse_ini_file('config.ini', true);

// Récupérer le nom du fichier et les noms des champs
$nom_fichier = $config['NOMFIC'];
$noms_champs = $config['NOMS'];

// Générer le contenu du fichier PHP
$formulaire_php = "<?php\n";
$formulaire_php .= "// Récupérer et afficher les valeurs du formulaire\n";

foreach ($noms_champs as $nom) {
    $formulaire_php .= "\$$nom = \$_POST['$nom'];\n";
    $formulaire_php .= "echo '$nom : ' . \$$nom . '<br>';\n";
}

$formulaire_php .= "?>\n";

// Écrire le contenu dans le fichier PHP (Form1.php)
file_put_contents($nom_fichier . '.php', $formulaire_php);

// Confirmation que le fichier PHP a été généré
echo "Le fichier $nom_fichier.php a été généré avec succès.";
?>
