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
$refreshToken = $accessTokenData['refresh_token'];

$activitiesURL = 'https://www.strava.com/api/v3/athlete/activities?access_token=' . $accessToken;

$ch = curl_init($activitiesURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$activitiesResponse = curl_exec($ch);
curl_close($ch);

$activitiesData = json_decode($activitiesResponse, true);

header('Content-Type: application/json');
echo json_encode($activitiesData);

exit;
?>

