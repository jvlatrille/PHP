<?php

$bdd = "bourse"; // Base de données
$host = "localhost"; // Hôte
$user = "root"; // Utilisateur
$pass = ""; // Mot de passe
$nomtable = "bourse"; /* Connection bdd */

$link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la base de données");

$query = "SELECT ville, indice FROM $nomtable ORDER BY ville";
$result = mysqli_query($link, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Fermez la connexion à la base de données avant d'envoyer l'image
mysqli_close($link);




header("Content-type: image/png");

$largeur = 500;
$hauteur = 450;
$img = imagecreate($largeur, $hauteur);

// La première couleur de la palette
// qui constitue la couleur de fond
// sera le rouge
$rouge = imagecolorallocate($img, 255, 0, 0);

$blanc = imagecolorallocate($img, 255, 255, 255);
$noir = imagecolorallocate($img, 0, 0, 0);
$vert = imagecolorallocate($img, 0, 255, 0);
$bleu = imagecolorallocate($img, 0, 0, 255);

// Titre bourse
imagestring($img, 5, ($largeur - imagefontwidth(5) * strlen("Bourse")) / 2, 10, "Bourse", $noir);

/*Graphe*/
$largeurBarre = 30;
$espace = 5;
$x = 50;
$yBase = $hauteur;

// Tableau de couleurs
$couleurs = [
    imagecolorallocate($img, 0, 255, 0),    // Vert
    imagecolorallocate($img, 0, 0, 255),    // Bleu
    imagecolorallocate($img, 255, 255, 0),  // Jaune
    imagecolorallocate($img, 0, 255, 255),  // Cyan
    imagecolorallocate($img, 255, 0, 255),  // Magenta
    imagecolorallocate($img, 128, 0, 128),  // Violet
    imagecolorallocate($img, 255, 165, 0),  // Orange
    imagecolorallocate($img, 0, 128, 128),  // Teal
    imagecolorallocate($img, 128, 128, 0)   // Olive
];

// Associer cha que ville à une couleur unique
$villeCouleurs = [];
$couleurIndex = 0;

foreach ($data as $key => $value) {
    $ville = $value['ville'];
    if (!isset($villeCouleurs[$ville])) {
        $villeCouleurs[$ville] = $couleurs[$couleurIndex % count($couleurs)];
        $couleurIndex++;
    }
    $couleur = $villeCouleurs[$ville];

    $y = $yBase - $value['indice'] * 10;
    imagefilledrectangle($img, $x, $y, $x + $largeurBarre, $yBase, $couleur);
    
    // Afficher le nom de la ville verticalement en blanc au-dessus de chaque barre
    $yText = $y - imagefontheight(2); // Ajuster la position verticale du texte
    $xText = $x + ($largeurBarre / 2) - (imagefontwidth(2) * strlen($ville) / 2) + 10; // Centrer le texte horizontalement et décaler un peu à droite
    imagestringup($img, 2, $xText, $yText, $ville, $blanc);
    $x += $largeurBarre + $espace;
}


// Envoyons le code de l'image 
imagepng($img);

// Et liberons les ressources
imagedestroy($img);

?>
