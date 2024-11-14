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
    #

    header("Location: admin-panel.php");
} else {
    header("Location: admin-panel.php");
}
?>