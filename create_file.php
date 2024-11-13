<?php
session_start();

// imports
require "config.php";
require "tool.php";

// set variable
$config=readConfig();
$permissions=$config['permissions'];
$banned=$config['banned'];
$root_dir=$config['rootFolder'];
$current_dir=$_SESSION["current_dir"];
$host=$_SESSION["host"];

// check permission
if ($permissions['fileCreate'] !== true) {
    header('Location: /');
    exit;
}

// create file
if (isset($_POST['create'])) {
    $fileName = $_POST['fileName'];
    if (!empty($fileName) && !is_have($fileName, '..')) {
        $targetFile = $current_dir.'/'.$fileName;

        // check forbidden
        $fileExtension = pathinfo($targetFile, PATHINFO_EXTENSION);
        if (in_array(strtolower($fileExtension), $banned)) {
            header('Location: /?dir='.$current_dir);
            exit;
        }

        // check exists
        if (!file_exists($targetFile)) {
            $file = fopen($targetFile, "w");
            if ($file) {

                // write init data
                fwrite($file, "File Created, Please Edit!");
                fclose($file);
                header('Location: /?dir='.$current_dir);
            } else {
                header('Location: /?dir='.$current_dir);
            }
        } else {
            header('Location: /?dir='.$current_dir);
        }
    } else {
        header('Location: /?dir='.$current_dir);
    }
}