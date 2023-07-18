function getActivities() {
  fetch('../../backend/get_activities/index.php', { method: 'GET' })
    .then(response => response.json())
    .then(activitiesData => {
      console.log(activitiesData);
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

// Appeler la fonction getActivities pour récupérer les activités lors du chargement de la page
getActivities();

