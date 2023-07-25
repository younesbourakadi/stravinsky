<?php
// Connexion à la base de données MySQL
$host = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'stravinsky';


$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données: " . $conn->connect_error);
}

// Vérifiez si le JSON est présent dans la requête
if (!isset($_GET['json'])) {
    die("Erreur : le JSON est manquant.");
}

$allStreamsData = json_decode($_GET['json'], true);

// Parcourir chaque ensemble de streams et stocker les données dans la base de données
foreach ($allStreamsData as $streamData) {
    $type = $streamData['type'];
    $data = json_encode($streamData['data']);

    // Insérer les données de stream dans la table ACTIVITIES
    $sql = "INSERT INTO ACTIVITIES (stream_type, stream_data) VALUES ('$type', '$data')";
    if ($conn->query($sql) === true) {
        echo "Données de stream de type " . $type . " insérées avec succès. <br>";
    } else {
        echo "Erreur lors de l'insertion des données de stream de type " . $type . ": " . $conn->error . "<br>";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
