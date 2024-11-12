<?php
session_start();

// imports
require "source/config.php";
require "source/tool.php";

// set variable
$config=readConfig();
$permissions=$config['permissions'];
$root_dir=$config['rootFolder'];
$current_dir=$_GET['dir'] ?? $root_dir;
$host=$_SERVER['HTTP_HOST'];

// read files
if (!is_dir($current_dir)) {
    mkdir($current_dir);
}
$files=scandir($current_dir);

// set header
header('Content-Type: charset=utf-8');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="source/stylesheet.css">
        <script src="source/upload_bar.js"></script>
        <title>PHP drive</title>
    </head>
    <body>
        
        <!-- upload form -->
        <?php if ($permissions['fileUpload'] === true): ?>
            <form action="filectrl/upload.php" method="post" enctype="multipart/form-data">
                <label>上传文件</label>
                <input type="file" name="file" id="file">
                <progress id="progress" value="0" max="100"></progress>
                <input type="submit" value="上传" hidden>
            </form>
        <?php endif; ?>
        <!-- upload form -->

        <!-- create file & folder form -->
        <div id="create_file_folder">
            <?php if ($permissions['folderCreate'] === true): ?>
                <form action="filectrl/create_dir.php" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="新建文件夹" id="folderName" name="folderName" required>
                    <input type="submit" name="create" value="创建">
                </form>
            <?php endif; ?>
            <?php if ($permissions['folderCreate'] === true && $permissions['fileCreate'] === true): ?>
                &nbsp;&nbsp; || &nbsp;&nbsp;
            <?php endif; ?>
            <?php if ($permissions['fileCreate'] === true): ?>
                <form action="filectrl/create_file.php" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="新建文件" id="fileName" name="fileName" required>
                    <input type="submit" name="create" value="创建">
                </form>
            <?php endif; ?>
        </div>
        <!-- create file & folder form -->

        <hr>

        <!-- file list -->
        <ul>
            <?php foreach ($files as $file): ?>
                <!-- ignore "." & ".." -->
                <?php if ($file === '.' || $file === '..') continue; ?>
                <!-- set path -->
                <?php $path=$current_dir.'/'.$file; ?>
                <!-- if folder -->
                <?php if (is_dir($path)): ?>
                    #
                <?php endif; ?>
                <!-- if file -->
                <?php if (is_file($path)): ?>
                    #
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <!-- file list -->

    </body>
</html>