<?php
session_start();

// imports
require "config.php";
require "tool.php";

// set variable
$config=readConfig();
$current_dir=$_SESSION['current_dir'];
$root_dir=$_SESSION['root_dir'];
$host=$_SESSION['host'];
$dir_path=$_GET['dir'] ?? "";
$file_path=$_GET["file"] ?? "";

// if rm dir
if (!empty($dir_path) && is_have($dir_path, $root_dir)) {
    rrmdir($dir_path);
    header('Location: /?dir='.$current_dir);
} else {
    header('Location: /');
}

// if rm file
if (!empty($file_path) && is_have($file_path, $root_dir)) {
    unlink($file_path);
    header('Location: /?dir='.$current_dir);
} else {
    header('Location: /');
}
?>