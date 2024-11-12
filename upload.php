<?php
session_start();

// imports
require $_SERVER['DOCUMENT_ROOT']."/source/config.php";

// set variable
$config=readConfig();
$current_dir=$_SESSION['current_dir'];
$host=$_SESSION['host'];

// get form data
$file=$_FILES['file'];

// save upload data
if (isset($file)) {

    // check size
    if ($file['size'] > $config['uploadMaxSize']) {
        header('Location: /?dir='.$current_dir);
    }

    // save file
    $targetFile = (string)$current_dir.'/'.$file['name'];
    move_uploaded_file($file['tmp_name'], $targetFile);

    // back
    // header('Location: /?dir='.$current_dir);
    echo '上传成功';
} else {
    header('Location: /?dir='.$current_dir);
}
?>