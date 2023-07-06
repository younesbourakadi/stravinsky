// connect_strava.php
<?php
$clientID = '104900';
$clientSecret = '1138cc3440dbfccf0356dd798935bd7daad531f5';
$redirectURI = 'http://localhost/stravinsky/backend/activities/';

$authorizationParams = [
    'client_id' => $clientID,
    'redirect_uri' => $redirectURI,
    'response_type' => 'code',
    'scope' => 'activity:read_all',
];

if (isset($_GET['code'])) {
    $authorizationCode = $_GET['code'];

    $accessTokenParams = [
        'client_id' => $clientID,
        'client_secret' => $clientSecret,
        'code' => $authorizationCode,
        'grant_type' => 'authorization_code',
    ];

    $accessTokenURL = 'https://www.strava.com/api/v3/oauth/token';

    $ch = curl_init($accessTokenURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($accessTokenParams));
    $accessTokenResponse = curl_exec($ch);
    curl_close($ch);

    $accessTokenData = json_decode($accessTokenResponse, true);
    $accessToken = $accessTokenData['access_token'];

    // Redirect to activities.php with the access token as a query parameter
    $activitiesURL = 'http://localhost/stravinsky/activities/';
    $redirectURL = $activitiesURL . '?access_token=' . urlencode($accessToken);
    header('Location: ' . $redirectURL);
    exit;
} else {
    $authorizationURL = 'https://www.strava.com/api/v3/oauth/authorize?' . http_build_query($authorizationParams);
    header('Location: ' . $authorizationURL);
    exit;
}
?>
