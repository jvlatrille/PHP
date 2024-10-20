<?php


echo "<h2>Récupérer l'adresse IP et la Classer</h2>";

$clientIP = $_SERVER['REMOTE_ADDR'];
echo "Adresse : $clientIP (";

// On choppe le premier octet de l'adresse IP pour voir si c'est une classe A, B, ou C
$IP = explode('.', $clientIP);
$premierOctet = (int)$IP[0];

// On fait le tri en fonction de la plage d'IP
if ($premierOctet < 128) {
    echo "classe A)";
} elseif ($premierOctet < 192) {
    echo "classe B)";
} else {
    echo "classe C)";
}
echo "<hr>"; 


// Lire un fichier CSV (ici restos.csv) et afficher son contenu : Nom, Prénom, Restaurant
echo "<h2>Liste des restos</h2>";
$file = fopen('restos.csv', 'r'); // Ouvre le fichier en mode lecture (r)

while (!feof($file)) { // Tant qu'on n'est pas à la fin du fichier
    $line = fgets($file); // On choppe la ligne en cours
    $data = explode(';', $line); // On découpe avec le séparateur ";"

    // On récupère Nom, Prénom, et le resto
    $nom = ($data[0]);
    $prenom = ($data[1]);
    $restaurant = ($data[2]);
    // Affichage
    echo "Nom : $nom <br> Prénom : $prenom <br> Restaurant : $restaurant <br> <hr>";
}

fclose($file); // Et on n'oublie pas de fermer le fichier après (les bonnes pratiques)


// Compteur de visites pour notre page web (version avec un seul passage sur le fichier)

echo "<h2>Compteur de visites</h2>";
$visites = 0;
echo "Nombre de visites initialisé : $visites <br>";

// On récupère le compteur dans le fichier
$visites = (int) file_get_contents('compteur.txt');
// On ajoute une visite parce qu'on est là
$visites++;
// On met à jour le fichier compteur
file_put_contents('compteur.txt', $visites);

// On balance l'info sur le nombre de visites
echo "Nombre de visites : $visites";