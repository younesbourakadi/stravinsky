// Fonction pour rediriger vers la page de connexion Strava
function redirectToStrava() {
  window.location.href = "../../backend/connect_strava/connect_strava.php";
}

// Fonction pour récupérer et afficher les activités de course à pied
function fetchRunningActivities() {
  const accessToken = localStorage.getItem("access_token");
  console.log(accessToken);

  fetch("../../backend/activities/index.php?access_token=" + accessToken)
    .then((response) => response.json())
    .then((data) => {
      // Obtenez la référence de l'élément HTML où vous voulez afficher les données
      const activitiesContainer = document.getElementById(
        "activities-container"
      );

      // Créez un élément <ul> pour afficher les activités
      const activitiesList = document.createElement("ul");

      // Parcourez les données des activités et créez des éléments <li> pour chaque activité
      data.forEach((activity) => {
        const activityItem = document.createElement("li");
        activityItem.textContent = activity.name;
        activitiesList.appendChild(activityItem);
      });

      // Ajoutez la liste des activités à l'élément container
      activitiesContainer.appendChild(activitiesList);
      console.log(accessToken);
    })
    .catch((error) => {
      console.error(error);
    });
}

// Code à exécuter après la redirection depuis Strava
if (window.location.pathname === "/stravinsky/backend/connect_page.php") {
  // Récupérez l'access token depuis l'URL ou autre méthode
  const urlParams = new URLSearchParams(window.location.search);
  const accessToken = urlParams.get("access_token");

  // Stockez l'access token dans le localStorage
  localStorage.setItem("access_token", accessToken);

  // Appel de la fonction pour récupérer et afficher les activités de course à pied
  fetchRunningActivities();
}
