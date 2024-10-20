<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>On s'en fout (c'est le TP2)</title>
</head>
<body>

    <!-- Formulaire pour récupérer les infos de don : Nom, Age, Mail, et le montant du don -->
    <h2>Faire un Don</h2>
    <form action="" method="get">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br><br>

        <label for="mail">Mail:</label>
        <input type="email" id="mail" name="mail" required><br><br>

        <label for="don">Valeur en € du don:</label>
        <input type="number" id="don" name="don" required><br><br>

        <!-- Bouton de validation du formulaire -->
        <input type="submit" value="OK">
    </form>

    <hr>

    <?php
    // Si le formulaire est soumis, on récupère les données du formulaire
    if (isset($_GET['nom']) && isset($_GET['age']) && isset($_GET['mail']) && isset($_GET['don'])) {
        $nom = $_GET['nom'];
        $age = $_GET['age'];
        $mail = $_GET['mail'];
        $don = $_GET['don'];

        // On formate les données pour les ajouter dans le fichier (genre on met tout sur une ligne dans une variable)
        $data = "Nom : $nom | Age : $age | Mail : $mail | Don : $don |\n";

        // On ouvre le fichier en mode append (a)
        $file = fopen('resultat.txt', 'a');
        fwrite($file, $data);
        fclose($file);

        // On affiche les infos reçues
        echo "Merci $nom pour votre don de $don €. Vos informations ont été enregistrées.<br><br>";
    }
    ?>

    <!-- Bouton pour voir les résultats des dons -->
    <h2>Voir les Résultats des Dons</h2>
    <form action="" method="post">
        <input type="submit" name="resultats" value="Afficher Résultats">
    </form>

    <?php
    // Si le bouton "resultats" est cliqué
    if (isset($_POST['resultats'])) {
        // On ouvre le fichier où on a enregistré les dons
        $file = fopen('resultat.txt', 'r');
        $total_dons = 0;
        $total_age = 0;
        $count = 0;

        // On boucle sur chaque ligne du fichier
        while (!feof($file)) {
            $line = fgets($file);
            $data = explode('|', $line);

            // On récupère les infos depuis la ligne du fichier
            if (isset($data[0], $data[1], $data[2], $data[3])) {
                $nom = trim(explode(':', $data[0])[1]);
                $age = trim(explode(':', $data[1])[1]);
                $mail = trim(explode(':', $data[2])[1]);
                $don = trim(explode(':', $data[3])[1]);

                // On calcule le total des dons et la moyenne d'âge
                $total_dons += (int)$don;
                $total_age += (int)$age;
                $count++;

                // On simule l'envoi d'un mail pour rappeler au donneur son don
                mail($mail, "Objet du mail", "Mail envoyé à $mail : Merci $nom pour votre don de $don €. Total collecté : $total_dons €.<br>") ;
            }
        }

        fclose($file); // bonne pratiques

        // Calcul de la moyenne d'âge
        if ($count > 0) {
            $moyenne_age = $total_age / $count;
            echo "<br>Moyenne d'âge des donneurs : $moyenne_age ans.<br>";
        } else {
            echo "Pas encore de dons.";
        }
    }
    ?>
</body>
</html>
