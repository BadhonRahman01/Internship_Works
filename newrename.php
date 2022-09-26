<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Rename Tool</title>
</head>
<style>
  .btn {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 12px 30px;
    cursor: pointer;
    font-size: 20px;
  }

  .btn:hover {
    background-color: RoyalBlue;
  }

  .grid-container {
    display: grid;
    justify-content: space-evenly;
    margin: 20px;

  }

  .center {
    height: 600px;
    width: 500px;

  }

  .container {
    height: 100vh;
    background: #9E9E9E;
  }

  body {
    text-align: center;
  }
</style>

<body style="background-color:powderblue;">


  <div class="container d-flex justify-content-center align-items-center">
    <div class="cen">
      <div class="h4 pb-2 mb-4 text-danger border-bottom border-success">
        <h1> PHP File Rename Tool <h1>
      </div>


      <div class="grid-container">
        <div class="mb-3 ">
          <form action="" method="POST">
            <p class="fs-3">Select a file to rename: </p>
            <input class="form-control" type="file" name="old_name" id="old_name">
        </div>


        <label for="" class="form-label fs-3">Rename File to:</label>

        <input type="text" class="form-control" name="new_name" id="new_name">
        <br>
        <input type="submit" name="Submit" class="btn btn-primary" value="Submit">
        <br>
        <Buttion type="download" name="Download" class="btn btn-primary">Download </Buttion>
      </div>
      <?php require_once 'rntool.php' ?>
      </form>

    </div>
  </div>






</body>

</html>