<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP1 - Ex2</title>
</head>

<body>
    <?php
    $clientIP = $_SERVER['REMOTE_ADDR'];
    echo "Adresse : $clientIP (";
    
    $IP = explode('.', $clientIP);
    $premierOctet = (int)$IP[0];
    
    if ($premierOctet < 128) {
        echo "classe A)";
    } elseif ($premierOctet < 192) {
        echo "classe B)";
    } else {
        echo "classe C)";
    }
    ?>

</body>

</html>