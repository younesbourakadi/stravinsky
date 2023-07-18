<?php
if (isset($_GET['code'])) {
    $authorizationCode = $_GET['code'];
    
    $clientId = "104900";
    $clientSecret = "1138cc3440dbfccf0356dd798935bd7daad531f5";

    $accessTokenParams = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'code' => $authorizationCode,
        'grant_type' => 'authorization_code',
    ];

    $accessTokenURL = 'https://www.strava.com/oauth/token';

    $ch = curl_init($accessTokenURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($accessTokenParams));
    $accessTokenResponse = curl_exec($ch);
    curl_close($ch);

    // Redirigez l'utilisateur vers get_activities/index.php avec les tokens d'accès en tant que paramètres de requête
    $redirectURL = '/stravinsky/backend/get_activities/index.php';
    $redirectURL .= '?accessTokenResponse=' . urlencode($accessTokenResponse);

    header('Location: ' . $redirectURL);
    exit;
} else {
    // Redirigez l'utilisateur vers une autre page s'il n'y a pas de code d'autorisation
    header('Location: /stravinsky/backend/connect_strava/connect_strava.php');
    exit;
}
?>

