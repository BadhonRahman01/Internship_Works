<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Web Crawler</title>
</head>
<body style="background-color:powderblue;">
<h1 text-align="enter"> PHP Web Crawler <h1>

<form action="script.php" method="POST">
    <label for="" class="form-label">Crawl URL:</label>
    <input type="text" class="form-control-md" name="url" id="url" >
    <input type="submit" name="Submit" class="btn btn-primary" value="Submit" >
    </form>

<?php require 'process.php' ?>  

</body>
</html>