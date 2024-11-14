<?php

function is_binary($filePath) {
    $handle = fopen($filePath, 'rb');
    if ($handle === false) {
        throw new Exception("无法打开文件: $filePath");
    }
    $buffer = fread($handle, 1024);
    fclose($handle);
    for ($i = 0; $i < strlen($buffer); $i++) {
        $byte = $buffer[$i];
        $ord = ord($byte);
        if ($ord < 32 && $ord != 9 && $ord != 10 && $ord != 13) {
            return true;
        }
    }
    return false;
}

function set_login_status($username, $status) {
    setcookie("is_login", $status, 0, "*");
    setcookie("username", $username, 0, "*");
}

function get_login_username() {
    if (isset($_COOKIE["username"])) {
        return $_COOKIE["username"];
    }
}

function is_login() {
    return (isset($_COOKIE["is_login"]) && $_COOKIE["is_login"] === "true");
}

function is_checked($items, $item) {
    if ($items[$item] === true) {
        return 'checked';
    }
}

function is_have($string, $char) {
    return (strpos($string, $char) !== false);
}

function get_readme_content($file_path) {
    $file = file_get_contents($file_path);
    return $file;
}

function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir."/".$object)) {
                    rrmdir($dir."/".$object);
                } else {
                    unlink($dir."/".$object);
                }
            }
        }
        rmdir($dir);
    }
}

?>