<?php
session_start();

if (isset($_SESSION['accessTokenResponse'])) {
    $accessTokenResponse = $_SESSION['accessTokenResponse'];
} else {
    header('Location: /stravinsky/backend/connect_strava/connect_strava.php');
    exit;
}

$accessTokenData = json_decode($accessTokenResponse, true);
$accessToken = $accessTokenData['access_token'];

$activitiesURL = 'https://www.strava.com/api/v3/athlete/activities?access_token=' . $accessToken;
$ch = curl_init($activitiesURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$activitiesResponse = curl_exec($ch);
curl_close($ch);

$activitiesData = json_decode($activitiesResponse, true);

$allStreamsData = [];

foreach ($activitiesData as $activity) {
    $activityId = $activity['id'];

    if (!isActivityStored($activityId)) {
        $streamsURL = "https://www.strava.com/api/v3/activities/{$activityId}/streams?keys=distance,time&access_token={$accessToken}";
        $ch = curl_init($streamsURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $streamsResponse = curl_exec($ch);
        curl_close($ch);

        $streamsData = json_decode($streamsResponse, true);

        if (isset($streamsData[0]) && $streamsData[0]['type'] === 'distance') {
            $distanceData = json_encode($streamsData[0]['data']);
        } else {
            $distanceData = null;
        }

        // Vérifier si le stream 'time' est présent dans les données
        if (isset($streamsData[1]) && $streamsData[1]['type'] === 'time') {
            $timeData = json_encode($streamsData[1]['data']);
        } else {
            $timeData = null;
        }

        // Appeler la fonction pour stocker les données dans la base de données
        storeStreamsDataInDatabase($activityId, $distanceData, $timeData);
    }
}

function isActivityStored($activityId) {
    // Code pour vérifier si l'activité est déjà dans la base de données
    // Vous devrez écrire cette fonction en fonction de votre implémentation de la base de données
    // Vous pouvez utiliser une requête SELECT pour vérifier si l'activité existe déjà dans la table ACTIVITIES

    // Dans cet exemple, nous supposons que l'activité n'est pas stockée
    return false;
}

function storeStreamsDataInDatabase($activityId, $distanceData, $timeData) {
    $host = 'localhost';
    $dbname = 'stravinsky';
    $username = 'root';
    $password = 'root';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Gérer les erreurs en mode exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO ACTIVITIES (user_id, activity_id, stream_distance, stream_time) VALUES (1, :activityId, :distanceData, :timeData)");

        $stmt->bindParam(':activityId', $activityId);
        $stmt->bindParam(':distanceData', $distanceData);
        $stmt->bindParam(':timeData', $timeData);

        $stmt->execute();

        $conn = null;
    } catch(PDOException $e) {
        echo "Erreur lors de la connexion à la base de données: " . $e->getMessage();
    }
}
?>

