<?php
// Commence la session
session_start();

// Simule un login valide (dans un vrai cas, tu vérifierais dans une base de données)
$login_valide = "admin";
$pwd_valide = "admin";

// Vérifie si le formulaire a été soumis
if (isset($_POST['login']) && isset($_POST['pwd'])) {
    // Vérifie si les informations saisies sont correctes
    if ($_POST['login'] == $login_valide && $_POST['pwd'] == $pwd_valide) {
        // Enregistre les infos en session
        $_SESSION['login'] = $_POST['login'];
        header('Location: graph.php'); // Redirige vers la page graphique
        exit();
    } else {
        // Si mauvais login/mot de passe
        echo "Identifiants incorrects !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Connexion</h2>
    <form action="login.php" method="post">
        Login : <input type="text" name="login" required><br>
        Mot de passe : <input type="password" name="pwd" required><br>
        <input type="submit" value="Connexion">
    </form>
</body>
</html>
