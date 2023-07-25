console.log('get_streams');
function getActivities() {
  fetch('../../backend/get_streams/index.php')
    .then(response => response.json())
    .then(activitiesData => {
      console.log(activitiesData);
    })
    .catch(error => {
      console.error(error);
    });
}

getActivities();

