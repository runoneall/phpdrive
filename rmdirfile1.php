<?php
session_start();
$current_dir = $_SESSION["current_dir"];
$host = $_SESSION["HTTP_Host"];


$dir_path = $_GET['dir'];
$file_path = $_GET['file'];

if (empty($file_path)) {

    rrmdir($dir_path);
    header("Location: /?dir=".$current_dir);
} else {
    unlink($file_path);
    header("Location: http://".$host."/?dir=".$current_dir);
}
?>