<?php
// Informations de connexion à la base de données MySQL
$host = 'localhost';
$dbname = 'stravinsky';
$username = 'root';
$password = 'root';

try {
    // Créer une connexion PDO à la base de données
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Gérer les erreurs en mode exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer la requête pour récupérer les données des streams
    $stmt = $conn->prepare("SELECT * FROM ACTIVITIES");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fermer la connexion
    $conn = null;

    // Renvoyer les données au format JSON
    header('Content-Type: application/json');
    echo json_encode($result);
} catch(PDOException $e) {
    echo "Erreur lors de la connexion à la base de données: " . $e->getMessage();
}
?>

