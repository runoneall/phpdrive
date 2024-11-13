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
if ($permissions['fileEditor'] !== true) {
    header('Location: /');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_path = $_POST["file-path"];
    $content = $_POST["editor"];

    // ban root edit
    if (!is_have($file_path, $root_dir) || is_have($file_path, '..')) {
        header('Location: /?dir='.$current_dir);
        exit;
    }

    // check forbidden
    $fileExtension = pathinfo($file_path, PATHINFO_EXTENSION);
    if (in_array(strtolower($fileExtension), $banned)) {
        header('Location: /?dir='.$current_dir);
        exit;
    }

    // write & save file
    $file = fopen($file_path, "w");
    if ($file) {
        fwrite($file, $content);
        fclose($file);
        header('Location: /text_editor.php?file='.$file_path);
    } else {
        header('Location: /?dir='.$current_dir);
    }
} else {
    header('Location: /?dir='.$current_dir);
}
?>