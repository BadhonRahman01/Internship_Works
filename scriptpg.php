
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

        echo '<br /><br />';
        echo $file_url;

        //$path = $file_url;

        $images = glob("$file_url*.{jpg,jpeg,png}", GLOB_BRACE);

        echo '<br /><br />';
        foreach ($images as $i) {
            $img_url = $file_url . $i;
            header("Content-Type:" . $i);
            header("Content-Length: " . filesize($i));
            // readfile($i);
            echo "<div class=\"row\">";
            echo "<div class=\"column\">";
            printf("<img src='$img_url'/>", basename($i));
            //echo "<img src='$img_url'. $row['$i'] .alt=\"\" height=\"".$height."\" width=\"".$width."\" /><br />";
            echo "</div>";
            echo "</div>";
        }
    }
