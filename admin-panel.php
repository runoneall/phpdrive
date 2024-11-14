<?php
session_start();

// imports
require "config.php";
require "tool.php";

// set variable
$config=readConfig();
$root_dir=$config['rootFolder'];
$permissions=$config['permissions'];
$permissions_item=get_keys($permissions);
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
            <a href="#ChangeUsernamePassword" class="tab-link">更改登入信息</a>
            <a href="#FunctionSettings" class="tab-link">功能设置</a>
            <a href="#Logout" class="tab-link">退出</a>
            <div id="endtab"></div>
        </div>
        <!-- tabs -->

        <!-- change username & password -->
        <div id="ChangeUsernamePassword" class="tab-content">
            <form class="login-form" action="change-login.php" method="post" enctype="multipart/form-data">
                <label for="login-username">新用户名</label>
                <input type="text" name="login-username" id="login-username" required><br>
                <label for="login-password">&nbsp;&nbsp;&nbsp;新密码</label>
                <input type="password" name="login-password" id="login-password" required><br><br>
                <input id="login" type="submit" value="更改"><br><br>
            </form>
        </div>
        <!-- change username & password -->

        <!-- phpdrive function settings -->
        <div id="FunctionSettings" class="tab-content">
            <form action="change-settings.php" method="post" enctype="multipart/form-data">
                <table>

                    <!-- normal -->
                    <?php $README_checked=is_checked($config, 'showREADME'); ?>
                    <?php $rootFolder=$config['rootFolder']; ?>
                    <?php $uploadMaxSize=$config['uploadMaxSize']; ?>
                    <tr>
                        <th><label for="rootFolder">rootFolder</label></th>
                        <td><input type="text" name="rootFolder" id="rootFolder" value="<?php echo $rootFolder; ?>"><br></td>
                    </tr>
                    <tr>
                        <th><label for="uploadMaxSize">uploadMaxSize</label></th>
                        <td><input type="number" name="uploadMaxSize" id="uploadMaxSize" value="<?php echo $uploadMaxSize; ?>"></td>
                    </tr>
                    <tr>
                        <th><label for="showREADME">showREADME</label></th>
                        <td><input type="checkbox" name="showREADME" id="showREADME" value="README_checked" <?php echo $README_checked; ?>></td>
                    </tr>
                    <!-- normal -->

                    <!-- permissions -->
                    <?php foreach ($permissions_item as $key): ?>
                        <?php $checked=is_checked($permissions, $key); ?>
                        <tr>
                            <th><label for="<?php echo $key ?>"><?php echo $key ?></label></th>
                            <td><input type="checkbox" name="permissions[]" value="<?php echo $key ?>" id="<?php echo $key ?>" <?php echo $checked ?>></td>
                        </tr>
                    <? endforeach ?>
                    <!-- permissions -->

                    <!-- banned -->
                    <?php $banned=$config['banned']; ?>
                    <tr>
                        <th><label for="banned">Banned Exp</label></th>
                        <td><input type="text" name="banned" id="banned" value="<?php echo list_to_text($banned, ','); ?>"></td>
                    </tr>
                    <!-- banned -->

                </table>
                <br><input type="submit" value="保存更改">
            </form>
        </div>
        <!-- phpdrive function settings -->

        <!-- logout -->
        <div id="Logout" class="tab-content">
            <a href="/logout.php">退出登入</a>
            &nbsp;&nbsp; || &nbsp;&nbsp;
            <a href="/?dir=<?php echo $current_dir; ?>">仅返回</a>
        </div>
        <!-- logout -->

        <script src="tab.js"></script>
    </body>
</html>
