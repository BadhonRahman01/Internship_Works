<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styleg.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>photo Gallery</title>
</head>

<body>


  <div class="container">
    <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
    <img id="expandedImg" style="width:100%">
    <div id="imgtext"></div>
  </div>

  <div style="text-align:center">
    <h2>Photo Gallery</h2>
    <p>Click on the images below:</p>
  </div>
  <p class="fs-3">Select a Folder</p>
  <input class="form-control" type="url" name="folder" id="folder">

  <div class="row">
    <div class="column">
      <img src="m1.jpg" style="width:100%" onclick="myFunction(this);">
    </div>
    <div class="column">
      <img src="m2.jpg" style="width:100%" onclick="myFunction(this);">
    </div>
    <div class="column">
      <img src="m3.jpg" style="width:100%" onclick="myFunction(this);">
    </div>
    <div class="column">
      <img src="m4.jpg" style="width:100%" onclick="myFunction(this);">
    </div>

  </div>
  <div class="row">
    <div class="column">
      <img src="f1.jpg" style="width:100%" onclick="myFunction(this);">
    </div>
    <div class="column">
      <img src="f2.jpg" style="width:100%" onclick="myFunction(this);">
    </div>
    <div class="column">
      <img src="f3.jpg" style="width:100%" onclick="myFunction(this);">
    </div>
    <div class="column">
      <img src="f4.jpg" style="width:100%" onclick="myFunction(this);">
    </div>

  </div>


  <?php require_once 'pgallery.php' ?>

  <script>

  </script>



  <script src="scriptg.js"></script>
</body>

</html>