<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nom = isset($_POST['Nom']) ? htmlspecialchars($_POST['Nom']) : 'Non renseigné';
    echo 'Nom: ' . $Nom . '<br>';
    $Prenom = isset($_POST['Prenom']) ? htmlspecialchars($_POST['Prenom']) : 'Non renseigné';
    echo 'Prenom: ' . $Prenom . '<br>';
    $Age = isset($_POST['Age']) ? htmlspecialchars($_POST['Age']) : 'Non renseigné';
    echo 'Age: ' . $Age . '<br>';
    $Ville = isset($_POST['Ville']) ? htmlspecialchars($_POST['Ville']) : 'Non renseigné';
    echo 'Ville: ' . $Ville . '<br>';
} else {
    echo 'Aucune donnée soumise.';
}
?>