<!doctype html>
<html>

<head>
    <title> PHP Photo Gallery</title>
    <link href='simplelightbox-master/dist/simple-lightbox.min.css' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script type="text/javascript" src="simplelightbox-master/dist/simple-lightbox.jquery.min.js"></script>

    <link href='styleppg.css' rel='stylesheet' type='text/css'>
</head>

<body style="background-color:#9E9E9E;">
    <div class='container'>
        <div class="gallery">
            <h1> <img src="photo-gallery.png" alt="">PHP Photo Gallery <h1>


                    <form action="" method="POST">
                        <p class="fs-3">Select a folder </p>
                        <input class="form-control" type="file" name="folder_name" id="folder_name" webkitdirectory>
                        <br>
                        <input type="submit" name="select" class="btn btn-warning" value="Select">

                    </form>
                    <?php

                    if (isset($_POST['select'])) {
                        $folder_name = $_POST['folder_name'];
                        // $dot = ".";
                        $file_url_with_image = realpath($folder_name);

                        $ext = explode("'\'", $folder_name);

                        echo '<br /><br />';


                        $file_url = substr($file_url_with_image, 0, strpos($file_url_with_image, $ext[0]));

                        echo '<br /><br />';


                        //$path = $file_url;

                        $images = glob("$file_url*.{jpg,jpeg,png}", GLOB_BRACE);

                        $image_extensions = array("png", "jpg", "jpeg", "gif");


                        $file_url = 'images/';
                        if (is_dir($file_url)) {

                            if ($dh = opendir($file_url)) {
                                $count = 1;


                                while (($file = readdir($dh)) !== false) {

                                    if ($file != '' && $file != '.' && $file != '..') {


                                        $image_path = "images/" . $file;


                                        $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);

                                        if (
                                            !is_dir($image_path) &&
                                            in_array($image_ext, $image_extensions)
                                        ) {
                    ?>

                                            <!-- Image -->
                                            <a href="<?php echo $image_path; ?>">
                                                <img src="<?php echo $image_path; ?>" alt="" title="" />
                                            </a>

                                            <?php


                                            if ($count % 4 == 0) {
                                            ?>
                                                <div class="clear"></div>
                    <?php
                                            }
                                            $count++;
                                        }
                                    }
                                }
                                closedir($dh);
                            }
                        }
                    }
                    ?>
        </div>
    </div>


    <!-- Script -->
    <script type='text/javascript'>
        $(document).ready(function() {


            var gallery = $('.gallery a').simpleLightbox();
        });
        // document.getElementById("folder_name").addEventListener("change", function(event) {
        //     var output = document.querySelector("ul");
        //     var files = event.target.files;

        //     for (var i = 0; i < files.length; i++) {
        //         var item = document.createElement("li");
        //         item.innerHTML = files[i].webkitRelativePath;
        //         output.appendChild(item);
        //     };
        // }, false);
    </script>
</body>

</html>