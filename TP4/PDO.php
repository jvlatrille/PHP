<?php
$bdd = "bourse"; // Base de données
$host = "localhost"; // Hôte
$user = "root"; // Utilisateur
$pass = ""; // Mot de passe
$nomtable = "bourse"; // Nom de la table

// Connexion à la base de données
$link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la base de données");

$query = "SELECT ville, indice FROM $nomtable ORDER BY ville";
$result = mysqli_query($link, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Affichage des résultats
foreach ($data as $row) {
    echo 'Ville : ' . $row['ville'] . ', Indice : ' . $row['indice'] . '<br />';
}

// Fermez la connexion à la base de données
mysqli_close($link);
?>
