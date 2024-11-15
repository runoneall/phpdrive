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
        "uploadMaxSize"=> intval($_POST["uploadMaxSize"]),
        "showREADME"=> ($_POST["showREADME"] === "README_checked") ? true:false
    );

    // permissions config
    $post_permissions = $_POST["permissions"];
    $old_permissions_keys = get_keys($old_permissions);
    $new_permissions = array();
    foreach ($old_permissions_keys as $permission_key) {
        // if check
        if (in_array($permission_key, $post_permissions)) {
            $new_permissions[$permission_key] = true;
        }
        // if uncheck
        if (!in_array($permission_key, $post_permissions)) {
            $new_permissions[$permission_key] = false;
        }
    }
    $new_config["permissions"] = $new_permissions;

    // banned config
    $post_banned = $_POST['banned'];
    $new_banned = text_to_list($post_banned, ',');
    $new_config['banned'] = $new_banned;

    // save config
    writeConfig($new_config);
    header("Location: admin-panel.php");
} else {
    header("Location: admin-panel.php");
}
?>