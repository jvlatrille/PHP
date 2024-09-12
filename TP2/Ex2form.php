<?php

if (isset($_GET["nom"]) && isset($_GET["age"]) && isset($_GET["mail"]) && isset($_GET["don"])) {
    $nom = $_GET["nom"];
    $age = $_GET["age"];
    $mail = $_GET["mail"];
    $don = $_GET["don"];

    $fichier = fopen("Ex2resultat.txt", "a");

    fwrite($fichier, "Nom : " . $nom . " | ");
    fwrite($fichier, "Age : " . $age . " | ");
    fwrite($fichier, "Mail : " . $mail . " | ");
    fwrite($fichier, "Don : " . $don . " | \n");

    fclose($fichier);
    header("Location: Ex2.html");
    exit;
}

?>