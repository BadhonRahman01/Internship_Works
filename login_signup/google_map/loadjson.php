<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP JSON</title>
</head>
<body>
  <!-- <h1>READ JSON  OBJ WITH PHP</h1> -->


<?php
if(isset($_POST['Submit'])){

$radius = $_POST['radius'];
// echo $radius;
$type = $_POST['type'];
// echo $type;
$keyword = $_POST['keyword'];
// echo $keyword;

$json_url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=23.7732245%2C90.4075326&radius=".$radius."&type=".$type."&keyword=".$keyword."&key=AIzaSyBwWnTI_T-0AHcZK29ZIOTsK0KYYhMFqnM";
$json = file_get_contents($json_url);
$data = json_decode($json);

file_put_contents("map.json", $json);

// $results = $data->results;

// foreach ($results as $i) {
//     $Lat = $i->geometry->location->lat;
//     echo json_encode($Lat)."<br>";

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
  var icon = {
        scaledSize: new google.maps.Size(10, 20), // size
    };
  fetch('./map.json').then((response) => {
    return response.json()}).then((json) => {
    json.results.forEach( (i)=>{
      var icon = {
        scaledSize: new google.maps.Size(10, 10), // size
    };
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