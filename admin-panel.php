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
$username=get_login_username();

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
        <h1 id="title">Hello <?php echo $username; ?></h1>
        <hr><br>

        <!-- tabs -->
        <div class="tabs">
            <a href="#ChangeUsernamePassword" class="tab-link">更改用户名与密码</a>
            <a href="#FunctionSettings" class="tab-link">功能设置</a>
            <div id="endtab"></div>
        </div>
        <!-- tabs -->

        <!-- change username & password -->
        <div id="ChangeUsernamePassword" class="tab-content">
            <span>更改用户名与密码</span>
        </div>
        <!-- change username & password -->

        <!-- phpdrive function settings -->
        <div id="FunctionSettings" class="tab-content">
            <span>功能设置</span>
        </div>
        <!-- phpdrive function settings -->

        <script src="tab.js"></script>
    </body>
</html>
