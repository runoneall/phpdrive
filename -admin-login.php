<?php
session_start();
$current_dir = $_SESSION["current_dir"];

// 登录信息
$username = "admin";
$password = "123456";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_username = $_POST["UserName"];
    $post_password = $_POST["Password"];

    if ($post_username == $username && $post_password == $password) {
        setcookie("is_login", "true", time() + (86400 * 10), "/");
        setcookie("username", $username, time() + (86400 * 10), "/");
        header("Location: admin-panel.php");
    } else {
        header("Location: /?dir=".$current_dir);
    }
}
?>


<!-- <form action="admin-login.php" method="post" enctype="multipart/form-data">
    进入后台
    <input type="text" placeholder="用户名" id="UserName" name="UserName" required>
    <input type="password" placeholder="密码" id="Password" name="Password" required>
    <input type="submit" value="登录">
</form> -->