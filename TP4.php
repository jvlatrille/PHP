<?php

// Détails de la base de données
$base_de_donnees = "bourse";
$hote = "lakartxela.iutbayonne.univ-pau.fr";
$utilisateur = "roose";
$mot_de_passe = "roose";
$table = "bourse";

// Connexion à la base
$connexion = mysqli_connect($hote, $utilisateur, $mot_de_passe, $base_de_donnees) or die("Impossible de se connecter à la base de données");

// Requête pour récupérer les villes et indices
$requete = "SELECT ville, indice FROM $table ORDER BY ville";
$resultat = mysqli_query($connexion, $requete);

// On récupère les données dans un tableau
$donnees_bourse = [];
while ($ligne = mysqli_fetch_assoc($resultat)) {
    $donnees_bourse[] = $ligne;
}

mysqli_close($connexion); // bonne pratique

header("Content-Type: image/png"); // On indique que le contenu renvoyé est une image au format PNG

$largeur_image = 500;
$hauteur_image = 450;
$image = imagecreate($largeur_image, $hauteur_image);

// Palette de couleurs
$rouge = imagecolorallocate($image, 255, 0, 0);
$blanc = imagecolorallocate($image, 255, 255, 255);
$noir = imagecolorallocate($image, 0, 0, 0);

// Fond rouge
imagefill($image, 0, 0, $rouge);

// Titre du graphique
imagestring($image, 5, ($largeur_image - imagefontwidth(5) * strlen("Bourse")) / 2, 10, "Bourse", $noir);

// Définir les dimensions des barres
$largeur_barre = 30;
$espace_barres = 5;
$x_position = 50; // Position de départ pour les barres
$y_base = $hauteur_image; // Base des barres

// Liste de couleurs pour les différentes villes
$couleurs = [
    imagecolorallocate($image, 0, 255, 0),    // Vert
    imagecolorallocate($image, 0, 0, 255),    // Bleu
    imagecolorallocate($image, 255, 255, 0),  // Jaune
    imagecolorallocate($image, 0, 255, 255),  // Cyan
    imagecolorallocate($image, 255, 0, 255),  // Magenta
    imagecolorallocate($image, 128, 0, 128),  // Violet
    imagecolorallocate($image, 255, 165, 0),  // Orange
];

// Associer une couleur unique à chaque ville
$ville_couleurs = [];
$index_couleur = 0;

// Boucle sur les données pour dessiner chaque barre
foreach ($donnees_bourse as $bourse) {
    $ville = $bourse['ville'];
    $indice = $bourse['indice'];

    // Si la ville n'a pas encore de couleur, on lui en assigne une
    if (!isset($ville_couleurs[$ville])) {
        $ville_couleurs[$ville] = $couleurs[$index_couleur % count($couleurs)];
        $index_couleur++;
    }
    $couleur_ville = $ville_couleurs[$ville];

    // Calcul de la hauteur de la barre en fonction de l'indice
    $hauteur_barre = $indice * 10;

    // Dessiner la barre pour la ville
    imagefilledrectangle($image, $x_position, $y_base - $hauteur_barre, $x_position + $largeur_barre, $y_base, $couleur_ville);

    // Afficher le nom de la ville à la verticale au-dessus de la barre
    $y_texte = $y_base - $hauteur_barre - 15; // Position verticale du texte
    $x_texte = $x_position + ($largeur_barre / 2) - (imagefontwidth(2) * strlen($ville) / 2); // Centrer le texte
    imagestringup($image, 2, $x_texte, $y_texte, $ville, $blanc);

    // Passer à la position suivante pour la prochaine barre
    $x_position += $largeur_barre + $espace_barres;
}

// Générer l'image
imagepng($image);
imagedestroy($image);
