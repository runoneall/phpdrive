<?php
session_start();

// imports
require "config.php";
require "tool.php";

// set variable
$config=readConfig();
$permissions=$config['permissions'];
$current_dir=$_SESSION['current_dir'];
$root_dir=$config['rootFolder'];
$host=$_SESSION['host'];
$file_path=$_GET['file'] ?? "";

// check path
if (empty($file_path)) {
    header('Location: /?dir='.$current_dir);
    exit;
}

// check permission
if ($permissions['fileEditor'] !== true) {
    header('Location: /?dir='.$current_dir);
    exit;
}

// check file exists
if (!file_exists($file_path)) {
    header('Location: /?dir='.$current_dir);
    exit;
}

// ban root edit
if (!is_have($file_path, $root_dir) || is_have($file_path, '..')) {
    header('Location: /?dir='.$current_dir);
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
        <link rel="stylesheet" href="editor.css">
        <title>BuildIn Editor</title>
    </head>
    <body>
        <form action="edit_text.php" method="post">
            <br>
            <div class="file-info">
                编辑:&nbsp;
                <input type="text" id="file-path" name="file-path" value=<?php echo $file_path ?> readonly>
            </div>
            <div class="editor-menu">
                &nbsp;&nbsp;
                <a id="unsave" href="/?dir=<?php echo $current_dir; ?>">退出</a>
                &nbsp;&nbsp;
                <input id="save" type="submit" value="保存">
            </div>
            <div class="editor-container">
                <div class="line-numbers"></div>
                <textarea id="editor" name="editor"><?php echo file_get_contents($file_path); ?></textarea>
            </div>
            <script src="line_num.js"></script>
        </form>
    </body>
</html>