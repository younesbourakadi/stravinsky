function getActivities() {
  fetch('../../backend/get_activities/index.php')
    .then(response => response.json())
    .then(activitiesData => {
      console.log(activitiesData);
    })
    .catch(error => {
      console.error(error);
    });
}

getActivities();

