function redirectToStrava() {
  const clientId = "104900"; // Remplacez par votre client ID Strava
  const redirectUri = encodeURIComponent("http://localhost/stravinsky/backend/exchange_token/");
  const responseType = "code";
  const scope = "activity:read_all";

  const url = `https://www.strava.com/oauth/authorize?response_type=${responseType}&client_id=${clientId}&redirect_uri=${redirectUri}&scope=${scope}`;

  window.location.href = url;
}


