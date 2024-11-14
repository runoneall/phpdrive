<?php
session_start();

// imports
require "config.php";
require "tool.php";

// set variable
$config=readConfig();
$old_permissions=$config["permissions"];
$current_dir=$_SESSION["current_dir"];
$host=$_SESSION["host"];

// check login status
if (!is_login()) {
    header('Location: /admin-login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // normal config
    $new_config = array(
        "login"=> $config['login'],
        "rootFolder"=> $_POST["rootFolder"],
        "uploadMaxSize"=> $_POST["uploadMaxSize"],
        "showREADME"=> ($_POST["showREADME"] === "README_checked") ? true:false
    );

    // permissions config
    $post_permissions = $_POST["permissions"];
    $old_permissions_keys = get_keys($old_permissions);
    $new_permissions = array();
    foreach ($post_permissions as $permission) {
        echo $permission." --- ";
    }

    // header("Location: admin-panel.php");
} else {
    header("Location: admin-panel.php");
}
?>