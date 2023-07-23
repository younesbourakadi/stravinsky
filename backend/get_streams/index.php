<?php
session_start();

if (isset($_SESSION['accessTokenResponse'])) {
    $accessTokenResponse = $_SESSION['accessTokenResponse'];
    // unset($_SESSION['accessTokenResponse']);
} else {
    // Redirigez l'utilisateur s'il n'y a pas de données d'accès
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

    $streamsURL = "https://www.strava.com/api/v3/activities/{$activityId}/streams?keys=time,distance,altitude,heartrate&access_token={$accessToken}";
    $ch = curl_init($streamsURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $streamsResponse = curl_exec($ch);
    curl_close($ch);

    $streamsData = json_decode($streamsResponse, true);

    $allStreamsData[] = $streamsData;
}
header('Content-Type: application/json');
echo json_encode($allStreamsData);
exit;
?>

