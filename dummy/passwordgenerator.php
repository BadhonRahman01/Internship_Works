<html>
<head>
<link type="text/css" rel="stylesheet" href="stylepg.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<div id="wrapper">

<div id="signup_form">
<?php
function randomPassword() {
  $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $pass = array(); //remember to declare $pass as an array
  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
  }
  return implode($pass); //turn the array into a string
}
?>

<p id="signup_label">Password Generator</p>
<form method="post" action="generate_password.php">
    <div class="d-grid gap-2 col-6 mx-auto">
        <button class="btn btn-primary" type="button" value="randomPassword">Generate Password</button>
      </div>
      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="inputPassword6" class="col-form-label">Generated Password:</label>
        </div>
        <div class="col-auto">
          <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
        </div>

      </div>
      <br>
 <Button type="Button" name="signup" value="Copy Password"> </button>
</form>
</div>

</div>
</body>
</html>