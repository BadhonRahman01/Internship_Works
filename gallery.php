<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleg.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Photo Gallery</title>
</head>
<style>

</style>

<body style="background-color:powderblue;">



    <h1> PHP Photo Gallery <h1>


            <form action="gallery.php" method="POST">
                <p class="fs-3">Select a folder </p>
                <input class="form-control" type="file" name="folder_name" id="folder_name">
                <br>
                <input type="submit" name="select" class="btn btn-primary" value="Select">

            </form>
            <?php require_once 'scriptpg.php' ?>


            <!-- <div class="row">
                <div class="column">
                    <img src="<?php $img_url ?>" style="width:100%" onclick="myFunction(this);">
                </div>
            </div> -->



</body>

</html>