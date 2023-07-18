<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$accessTokenResponse = isset($_GET['accessTokenResponse']) ? $_GET['accessTokenResponse'] : '';
if (empty($accessTokenResponse)) {
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


echo json_encode($activitiesData);
?>

