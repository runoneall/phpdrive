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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheet.css">
        <link rel="stylesheet" href="admin-panel.css">
        <title>Admin Panel</title>
    </head>
    <body>
        <div class="tabs">
            <a href="#tab1" class="tab-link">Tab 1</a>
            <a href="#tab2" class="tab-link">Tab 2</a>
            <a href="#tab3" class="tab-link">Tab 3</a>
        </div>

        <div id="tab1" class="tab-content">
            <h2>Content of Tab 1</h2>
            <p>This is the content for tab 1.</p>
        </div>
        <div id="tab2" class="tab-content">
            <h2>Content of Tab 2</h2>
            <p>This is the content for tab 2.</p>
        </div>
        <div id="tab3" class="tab-content">
            <h2>Content of Tab 3</h2>
            <p>This is the content for tab 3.</p>
        </div>
        <script src="tab.js"></script>
    </body>
</html>
