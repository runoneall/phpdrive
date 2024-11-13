<?php
session_start();

// imports
require "config.php";

// set variable
$config=readConfig();
$permissions=$config['permissions'];
$current_dir=$_SESSION['current_dir'];
$host=$_SESSION['host'];

// check permission
if ($permissions['fileUpload'] !== true) {
    header('Location: /');
    exit;
}

// save upload data
if (isset($_FILES['file'])) {
    $file=$_FILES['file'];

    // check size
    if ($file['size'] > $config['uploadMaxSize']) {
        header('Location: /?dir='.$current_dir);
    }

    // save file
    $targetFile = (string)$current_dir.'/'.$file['name'];
    move_uploaded_file($file['tmp_name'], $targetFile);

    // back
    header('Location: /?dir='.$current_dir);
} else {
    header('Location: /?dir='.$current_dir);
}
?>