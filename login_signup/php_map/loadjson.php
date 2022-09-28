<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP JSON</title>
</head>
<body>
  <h1>READ JSON  OBJ WITH PHP</h1>


<?php
$url = $_POST['url'];


$json = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=23.7732245%2C90.4075326&radius=1500&type=restaurant&keyword=burger&key=AIzaSyBwWnTI_T-0AHcZK29ZIOTsK0KYYhMFqnM');
$data = json_decode($json);

$results = $data->results;

foreach ($results as $i) {
    $Lat = $i->geometry->location->lat;
    echo json_encode($Lat)."<br>";

  }


?>

<script type="text/javascript">
    let map;
let infoWindow;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 23.771587800856683, lng: 90.41193936800533 },
    zoom: 16,
    mapTypeId: "roadmap",
  });
  infoWindow = new google.maps.InfoWindow();

  fetch('./postman.json').then((response) => {
    return response.json()}).then((json) => {
    json.results.forEach( (i)=>{
      const LatLng = { lat: i.geometry.location.lat, lng: i.geometry.location.lng };
      new google.maps.Marker({
        position: LatLng,
        map: map,
        title: i.name,
        icon: i.icon,
        icon_background_color:i.icon_background_color,
        rating: i.rating,
        icon_mask_base_uri:i.icon_mask_base_uri
      });
    })
  });
  
}
window.initMap = initMap;
</script>
</body>
</html>


if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function (p) {
                var mapOptions = {
                  center: { lat: 23.7732245, lng: 90.4075326 },
                  zoom: 16,
                  mapTypeId: google.maps.MapTypeId.ROADMAP,
                };


                 const LatLng = { lat: i.geometry.location.lat, lng: i.geometry.location.lng };
                    var marker = new google.maps.Marker({
                      position: LatLng,
                       map: mapOptions,
                       title: i.name,
                       icon: i.icon,
                       open_now: i.opening_hours.open_now,
                       rating: i.rating
                     });
                 var map = new google.maps.Map(
                  document.getElementById("dvMap"),
                  mapOptions
                );
              });
            } else {
              alert("Geo Location feature is not supported in this browser.");
            }