<?php
$nbPhotos = $_POST['nbPhotos'];

echo '<form enctype="multipart/form-data" action="upload.php" method="POST">';
echo '<input type="hidden" name="nbphotos" value="' . $nbPhotos . '">';

for ($i = 1; $i <= $nbPhotos; $i++) {
    echo '<br><input type="file" name="photo' . $i . '"><br>';
}

echo '<br><br><input type="submit" value="Télécharger Photos">';
echo '</form>';


exit;
?>