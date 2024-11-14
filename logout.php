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

// logout
set_login_status(get_login_username(), "false");
header('Location: /admin-login.php');
?>