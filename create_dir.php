<?php
session_start();

// imports
require "config.php";
require "tool.php";

// set variable
$config=readConfig();
$permissions=$config['permissions'];
$root_dir=$config['rootFolder'];
$current_dir=$_SESSION["current_dir"];
$host=$_SESSION["host"];

// check permission
if ($permissions['folderCreate'] !== true) {
    header('Location: /');
    exit;
}

// create dir
if (isset($_POST['create'])) {
    $folderName = $_POST['folderName'];
    if (!empty($folderName) && !is_have($folderName, '.') && !is_have($folderName, '..')) {
        $targetDirectory = $current_dir.'/'.$folderName;
        if (!file_exists($targetDirectory)) {
            if (mkdir($targetDirectory)) {
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
?>