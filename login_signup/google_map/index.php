<html>
  <head>
    <title>Add Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <link rel="stylesheet" type="text/css" href="style.css" />
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body style="background-color:#B2DFDB;">
    <h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
    <form action="index.php" method="POST">
        <label for="" class="form-label">Radius:</label>
        <input type="number" class="form-control-md" name="radius" id="url" >
        <label for="" class="form-label">Type:</label>
        <input type="text" class="form-control-md" name="type" id="url" >
        <label for="" class="form-label">Keyword:</label>
        <input type="text" class="form-control-md" name="keyword" id="url" >
        <input id="submit" type="submit" name="Submit" class="btn btn-primary" value="Submit" >
        </form>
    <div id="map"></div>

    <!-- 
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEVVKQzkyOrxNHyH96sAd9q9COin1qdh4&callback=initMap&v=weekly"
      defer
    ></script>
    <?php require './loadjson.php' ?>
  </body>
</html>