<!doctype html>
<html>

<head>
    <title>How to make photo gallery from image directory with PHP</title>
    <link href='simplelightbox-master/dist/simple-lightbox.min.css' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" src="simplelightbox-master/dist/simple-lightbox.jquery.min.js"></script>

    <link href='styleppg.css' rel='stylesheet' type='text/css'>
</head>

<body>
    <h1> PHP Photo Gallery <h1>


            <form action="s" method="POST">
                <p class="fs-3">Select a folder </p>
                <input class="form-control" type="file" name="folder_name" id="folder_name">
                <br>
                <input type="submit" name="select" class="btn btn-primary" value="Select">

            </form>
            <div class='container'>
                <div class="gallery">

                    <?php
                    if (isset($_POST['select'])) {
                        $folder_name = $_POST['folder_name'];
                        // $dot = ".";
                        $file_url_with_image = realpath($folder_name);
                        echo $file_url_with_image;
                        $ext = explode("'\'", $folder_name);

                        echo '<br /><br />';
                        echo $ext[0];

                        $file_url = substr($file_url_with_image, 0, strpos($file_url_with_image, $ext[0]));
                        echo $file_url;

                        // Image extensions
                        $image_extensions = array("png", "jpg", "jpeg", "gif");

                        // Target directory
                        //$file_url = 'images/';
                        if (is_dir($file_url)) {

                            if ($dh = opendir($file_url)) {
                                $count = 1;

                                // Read files
                                while (($file = readdir($dh)) !== false) {

                                    if ($file != '' && $file != '.' && $file != '..') {

                                        // Thumbnail image path
                                        // $thumbnail_path = "images/thumbnail/" . $file;

                                        // Image path
                                        $image_path = "$file_url" . $file;

                                        //$thumbnail_ext = pathinfo($thumbnail_path, PATHINFO_EXTENSION);
                                        $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);

                                        // Check its not folder and it is image file
                                        if (
                                            !is_dir($image_path) &&
                                            //in_array($thumbnail_ext, $image_extensions) &&
                                            in_array($image_ext, $image_extensions)
                                        ) {
                    ?>

                                            <!-- Image -->
                                            <a href="<?php echo $image_path; ?>">
                                                <img src="<?php echo $image_path; ?>" alt="" title="" />
                                            </a>
                                            <!-- --- -->
                                            <?php

                                            // Break
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

                    // Intialize gallery
                    var gallery = $('.gallery a').simpleLightbox();
                });
            </script>
</body>

</html>