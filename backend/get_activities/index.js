function getActivities() {
  console.log('dff')
  fetch('index.php') // Modifiez le chemin vers le fichier get_activities.php
    .then(response => response.json())
    .then(activitiesData => {
      // Traitez les données des activités ici
      console.log(activitiesData);
      // ...
    })
    .catch(error => {
      console.error(error);
    });
}

// Appeler la fonction getActivities pour récupérer les activités lors du chargement de la page
getActivities();

