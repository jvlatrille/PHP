<?php

// Génération du formulaire si on a reçu le nombre de fichiers à uploader
if (isset($_POST['nb_fichiers'])) {
    $nombre_fichiers = $_POST['nb_fichiers']; // Récupération du nombre de fichiers

    echo "<form action='' method='post' enctype='multipart/form-data'>";
    // On passe le nombre de fichiers via un champ caché
    echo "<input type='hidden' name='nb_fichiers' value='$nombre_fichiers'>";

    // On génère un champ de fichier pour chaque photo à uploader
    for ($i = 0; $i < $nombre_fichiers; $i++) {
        echo "<label for='fichier$i'>Photo $i :</label>";
        echo "<input type='file' name='fichier$i' id='fichier$i' required><br><br>";
    }
    echo "<input type='submit' value='Envoyer les photos' name='envoyer_photos'>";
    echo "</form>";
}

// Étape 2 : Traitement des fichiers une fois envoyés
if (isset($_POST['envoyer_photos'])) {
    $nombre_fichiers = $_POST['nb_fichiers']; // Récupération du nombre de fichiers

    // On vérifie si le dossier 'upload' existe, sinon on le crée
    $dossier_upload = 'upload/';
    if (!is_dir($dossier_upload)) {
        mkdir($dossier_upload, 0777, true);
    }

    // Boucle pour traiter chaque fichier uploadé
    for ($i = 0; $i < $nombre_fichiers; $i++) {
        $nom_fichier = 'fichier' . $i; // On prépare le nom de chaque fichier

        if (isset($_FILES[$nom_fichier]) && $_FILES[$nom_fichier]['error'] == UPLOAD_ERR_OK) {
            $fichier_temporaire = $_FILES[$nom_fichier]['tmp_name']; // Chemin temporaire
            $nom_fichier_final = basename($_FILES[$nom_fichier]['name']); // Nom réel du fichier

            // Déplacement du fichier vers le dossier 'upload'
            if (move_uploaded_file($fichier_temporaire, $dossier_upload . $nom_fichier_final)) {
                echo "Photo $i : $nom_fichier_final uploadée avec succès.<br>";
            } else {
                echo "Erreur lors de l'upload de la photo $i.<br>";
            }
        } else {
            echo "Erreur avec la photo $i.<br>";
        }
    }
}

?>

<!-- Formulaire de départ pour demander combien de photos on veut uploader -->
<form action="" method="post">
    <label for="nb_fichiers">Combien de photos souhaitez-vous uploader ?</label>
    <input type="number" id="nb_fichiers" name="nb_fichiers" required>
    <input type="submit" value="OK">
</form>