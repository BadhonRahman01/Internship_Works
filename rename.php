
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

$fileToUpload = $newname= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fileToUpload"])) {
    $fileToUploadErr = "Name is required";
  }
  }
  
  if (empty($_POST["newname"])) {
    $newnameErr = "Email is required";
  }


$old_name = $_POST[basename('fileToUpload')];
$new_name = $_GET["newname"];

?>

<h2>PHP Rename Tool</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  Select a file to rename: <input type="file" name="fileToUpload" value="<?php echo $fileToUpload;?>">
</form>
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  <br><br>
  New File name: <input type="text" name="newname" value="<?php echo $newname;?>">

  <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>

<?php

if(rename( $old_name, $new_name)){
  echo "file name change sucessfully to", $new_name;
}else {
  echo "File name didnot change";
}

echo "<h2>Your file new file name changed from:</h2>";
echo $fileToUpload;
echo "<h2>to:</h2>";
echo $newname;
echo "<br>";

?>

</body>
</html>