<?php
// Démarre la session
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    // Redirige vers la page de login si non connecté
    header('Location: login.php');
    exit();
}

// Ici tu mets le code pour générer ton graphique
// Pour l'exemple, je vais juste afficher un texte simulant le graphique
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Graphique</title>
</head>
<body>
    <h2>Bienvenue dans la zone des membres</h2>
    <p>Votre login : <?php echo $_SESSION['login']; ?></p>

    <h3>Graphique Généré :</h3>
    <img src="https://www.chartgo.com/chart?type=bar&title=Exemple+de+Graphique" alt="Graphique généré">

    <br>
    <a href="logout.php">Déconnexion</a>
</body>
</html>
