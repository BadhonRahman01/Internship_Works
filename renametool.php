<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Rename Tool</title>
</head>
<body>
    <?php

$fileToUpload = $newname= "";

$old_name = $_POST[basename('fileToUpload')];
$new_name = $_GET["newname"];






if(rename( $old_name, $new_name)){
  echo "file name change sucessfully to", $new_name;
}else {
  echo "File name didnot change";
}

?>





<form action="" method="post" enctype="multipart/form-data">
  Select a file to rename:
  <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $fileToUpload;?>">

  <div class="mb-3">

    <label for="" class="form-label">Rename File to:</label>
    <input type="name" class="form-control" id="newname" value="<?php echo $newname;?>">
  </div>
<button type="submit" class="btn btn-primary">Rename File </button>

</form>






<?php

// s
?>



<script src="scriptrn.js"></script>
</body>
</html>