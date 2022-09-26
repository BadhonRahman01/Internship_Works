<?php
ini_set("default_socket_timeout", 10);
// session_start();
// include_once("newrename.php");

// if (isset($_POST['submit'])) {
//         //$old_file_name = "myfile";
//         $old_file_name = $_POST['old_name'];
//         $dot = ".";
//         echo $old_file_name;
if (strpos($old_file_name = $_POST['old_name'], $dot = ".") !== false) {
        //echo strpos($old_file_name, $dot);

        $ext = explode(".", $old_file_name);

        $new_file_name = $_POST['new_name'];
        $new_file_name_with_ext = $new_file_name . '.' . $ext[1];
        rename($old_file_name, $new_file_name_with_ext);
        echo " File name changed to: " . $new_file_name_with_ext;



        //}

        // $file_url = realpath($new_file_name_with_ext);
        // header('Content-Type: application/octet-stream');
        // header("Content-Transfer-Encoding: utf-8");
        // header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
        // readfile($file_url);
} else {
        // echo " File name changed to: " . $new_file_name_with_ext;
        // echo '<br /><br />';
        echo " Error: File extention is not valid!";
        echo '<br /><br />';
}
//}

if (isset($_POST['Download'])) {
        $old_file_name = $_POST['old_name'];
        $dot = ".";
        $ext = explode(".", $old_file_name);

        $new_file_name = $_POST['new_name'];
        $new_file_name_with_ext = $new_file_name . '.' . $ext[1];


        $file_url = realpath($new_file_name_with_ext);
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: utf-8");
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
        readfile($file_url);
}
