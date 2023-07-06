<?php
if (isset($_GET['access_token'])) {
  $accessToken = $_GET['access_token'];

  // Exemple : Récupération des données de course à pied de l'API Strava
  $activitiesURL = 'https://www.strava.com/api/v3/athlete/activities';

  $ch = curl_init($activitiesURL);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $accessToken
  ]);
  $activitiesResponse = curl_exec($ch);
  curl_close($ch);

  // Envoyer les données JSON au frontend
  header('Content-Type: application/json');
  echo $activitiesResponse;
  exit;
}
?>

