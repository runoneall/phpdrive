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
if (is_login()) {
    header('Location: /admin-panel.php');
    exit;
}

// set header
header('Content-Type: text/html;charset=utf-8');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesheet.css">
        <link rel="stylesheet" href="admin.css">
        <title>Admin Login</title>
    </head>
    <body>
        <div class="login-box">
            <form class="login-form" action="login.php" method="post" enctype="multipart/form-data">
                <label for="login-username">用户名</label>
                <input type="text" name="login-username" id="login-username" required><br>
                <label for="login-password">&nbsp;&nbsp;&nbsp;密码</label>
                <input type="password" name="login-password" id="login-password" required><br><br>
                <a id="back" href="/?dir=<?php echo $current_dir; ?>">返回</a>
                <input id="login" type="submit" value="登入"><br><br>
            </form>
        </div>
    </body>
</html>