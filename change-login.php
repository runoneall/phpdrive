<?php
session_start();

// imports
require "config.php";
require "tool.php";

// set variable
$config=readConfig();
$root_dir=$config['rootFolder'];
$current_dir=$_SESSION["current_dir"];
$host=$_SESSION["host"];

// check login status
if (!is_login()) {
    header('Location: /admin-login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get post info
    $post_username = $_POST["login-username"];
    $post_password = $_POST["login-password"];

    // change password
    $hashValue = hash("sha512", $post_username.$post_password);
    $config['login'] = $hashValue;
    writeConfig($config);
    set_login_status(get_login_username(), "false");
    header('Location: /admin-login.php');
} else {
    header("Location: admin-panel.php");
}
?>