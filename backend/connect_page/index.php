<?php
//phpinfo();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Stravinsky</title>
  <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  <meta content="utf-8" http-equiv="encoding">
  <link rel="stylesheet" href="../../static/css/styles.css">
</head>

<body>
  <nav class="navbar">
    <a class="navbar__logo" href="/">Stravinsky</a>
    <ul class="navbar__list">
      <li class="navbar__item">
        <a class="navbar__link navbar__link--active" href="/">Activités</a>
      </li>
      <li class="navbar__item">
        <a class="navbar__link navbar__link--active" href="/support">Contact</a>
      </li>
    </ul>
  </nav>
  <main role="main">
    <section class="jumbotron">
      <div class="container">
        <div class="right-section">
          <h1 class="pbv_brand">Stravinsky</h1>
          <p class="lead text-muted">
            Connectez-vous à Strava pour afficher vos records personnels de course.
          </p>
          <p class="lead text-muted">
            Vous pouvez trier et filtrer les distances de 100m à 50km.
          </p>
          <button onclick="redirectToStrava()" class="button">Connectez-vous à Strava</button>
        </div>
      </div>
    </section>
  </main>
  <footer class="container pt-3">
    <p class="text-muted pt-3" style="text-align: center">© Stravinsky 2023</p>
  </footer>

  <script src="../../frontend/js/oauthRedirect.js">

</script>

</body>

</html>
