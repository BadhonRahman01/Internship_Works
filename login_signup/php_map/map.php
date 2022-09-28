<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
</head>
<body>
    
    <form action="map.php" method="POST">
        <label for="" class="form-label">Radius:</label>
        <input type="text" class="form-control-md" name="radius" id="url" >
        <label for="" class="form-label">Type:</label>
        <input type="text" class="form-control-md" name="type" id="url" >
        <label for="" class="form-label">Keyword:</label>
        <input type="text" class="form-control-md" name="keyword" id="url" >
        <input type="submit" name="Submit" class="btn btn-primary" value="Submit" >
        </form>
        <div id="dvMap" style="width: 1500px; height: 730px"></div>
    <?php require 'process.php' ?>



    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
      defer
    ></script>
    <script type="text/javascript">

if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (p) {
        var LatLng = new google.maps.LatLng(
          p.coords.latitude,
          p.coords.longitude
        );
        var mapOptions = {
          center: LatLng,
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          
        };
        var map = new google.maps.Map(
          document.getElementById("dvMap"),
          mapOptions
        );
        var marker = new google.maps.Marker({
          position: LatLng,
          map: map,
          title:
            "Your location=Latitude: " +
            p.coords.latitude +
            "Longitude: " +
            p.coords.longitude,
        });
        google.maps.event.addListener(marker, "click", function (e) {
          var infoWindow = new google.maps.InfoWindow();
          infoWindow.setContent(marker.title);
          infoWindow.open(map, marker);
          // infoWindow.nearbySearch(mapOptions,map);
         
        });
       
       
        // *****get nearbySearch function starting here*****

      });
    } else {
      alert("Geo Location feature is not supported in this browser.");
    }
            </script>
</body>
</html>