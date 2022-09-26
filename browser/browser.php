<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <title>Web Browser</title>
  <style>
    input[type=text] {
      width: 130px;
      box-sizing: border-box;
      border: 2px solid rgb(201, 123, 123);
      border-radius: 4px;
      font-size: 16px;
      background-color: rgb(182, 208, 222);
      background-image: url('searchicon.png');
      background-position: 10px 10px;
      background-repeat: no-repeat;
      padding: 12px 20px 12px 40px;
      transition: width 0.4s ease-in-out;
    }

    input[type=text]:focus {
      width: 100%;
    }
  </style>
</head>

<body>



  <h2>Website Blocker</h2>

  <div class="input-group mb-3">
    <span class="input-group-text" name="block_url" id="block_url">Provide the website URL you want to block:</span>
    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="block">
    <input type="button" name="url_block"   value="Block this URL">
  </div>

  <form action="" method="POST">
    <p>Enter your URL here:</p>
    <i class="fa fa-search icon">
      <input class="fa fa-search icon" type="text" name="url" placeholder="Search..">
      <input type="button" name="url_search"  value="Search">
    </i>
  </form>
  <p id="demo"></p>
  <!-- <?php

  if (isset($_POST['url_block'])) {
    $url = $_POST['block'];
    echo $url;
  }

  ?> -->
  <script>
//     // Requiring fs module in which
//     // writeFile function is defined.
//     const fs = require('fs')

//     // Data which will write in a file.
//     let data = "Learning how to write in a file."

//     // Write data in 'Output.txt' .
//     fs.writeFile('Output.txt', data, (err) => {

//       // In case of a error throw err.
//       if (err) throw err;
//     })
//     ////////////////////////////////////////

//     function myFunction() {

//       console.log("hello");   
//       console.log("hello");
//       let data = document.getElementById('block');
//       console.log(data);
// }
  </script>

</body>

</html>