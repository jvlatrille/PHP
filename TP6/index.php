<?php
/* Question 1 */
echo "<h3>Question 1</h3>";

$dom = new DomDocument;
$dom->load("pays.xml");
$listePays = $dom->getElementsByTagName('pays');

foreach ($listePays as $pays) {
    if ($pays->firstChild) {
        echo $pays->firstChild->nodeValue . "<br />";
    }
}

echo "<br />";

/* Question 2 */
echo "<h3>Question 2</h3>";

$europe = $dom->getElementsByTagName('europe')->item(0);
if ($europe) {
    $listePaysEurope = $europe->getElementsByTagName('pays');
    foreach ($listePaysEurope as $pays) {
        if ($pays->firstChild) {
            echo $pays->firstChild->nodeValue . "<br />";
        }
    }
}

echo "<br />";

/* Question 3 */
echo "<h3>Question 3</h3>";
?>

<form method="post" action="">
    <label for="ville">Nom de la ville ou du pays :</label>
    <input type="text" id="ville" name="ville">
    <input type="submit" value="Rechercher">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $villeRecherchee = $_POST['ville'];
    $villeTrouvee = false;
    $suggestions = [];

    // Recherche dans les pays
    foreach ($listePays as $pays) {
        $nomPays = $pays->nodeValue;

        // Comparer la recherche avec le nom du pays
        if (stripos($nomPays, $villeRecherchee) !== false) {
            $villeTrouvee = true;
            $suggestions[] = $nomPays;
        }
    }

    // Si le pays est trouvé, afficher les résultats
    if ($villeTrouvee) {
        echo "<h3>Résultats de la recherche :</h3>";
        foreach ($suggestions as $suggestion) {
            echo $suggestion . "<br />";
        }
    } 
    
    // Bonus parce que chez le daron on s'emmerde (du coup ici je vais documenter)
    else {
        echo "<h3>Aucun pays trouvé pour : " . htmlspecialchars($villeRecherchee) . "</h3>"; // Afficher ville pas trouvée
        echo '<form method="post" action="">
                <input type="hidden" name="nouveauPays" value="' . htmlspecialchars($villeRecherchee) . '">
                <input type="submit" value="L\'ajouter ?">
              </form>';
    }
}

// Si on clique sur ajouter, on ajoute l'entrée
if (isset($_POST['nouveauPays'])) {
    $nouveauPays = $_POST['nouveauPays'];

    $dom = new DomDocument;
    $dom->load("pays.xml");

    // Vérifier si le continent <autre> existe, sinon le créer
    $autreContinent = $dom->getElementsByTagName('autre')->item(0);
    if (!$autreContinent) {
        // Créer le nouveau continent <autre> si inexistant
        $racine = $dom->getElementsByTagName('continents')->item(0);
        $autreContinent = $dom->createElement('autre');
        $racine->appendChild($autreContinent);
    }

    // Ajouter l'entrée
    $nouvelElementPays = $dom->createElement('pays', htmlspecialchars($nouveauPays));
    $autreContinent->appendChild($nouvelElementPays);

    // On save
    $dom->save("pays.xml");

    // On envoie un message comme quoi tout est bon
    echo "<h3>Le pays " . htmlspecialchars($nouveauPays) . " a été ajouté.</h3>";
}
?>