<?php
session_start();

// imports
require "config.php";
require "tool.php";

// set variable
$config=readConfig();
$root_dir=$config['rootFolder'];
$login_hash=$config['login'];
$current_dir=$_SESSION["current_dir"];
$host=$_SESSION["host"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_username = $_POST["login-username"];
    $post_password = $_POST["login-password"];
    $hashValue = hash("sha512", $post_username.$post_password);
    if ($hashValue === $login_hash) {
        set_login_status($post_username, "true");
        header("Location: admin-panel.php");
    } else {
        header("Location: admin-login.php");
    }
} else {
    header("Location: /?dir=".$current_dir);
}
?>