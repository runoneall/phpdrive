<?php
session_start();

// imports
require "config.php";

// set variable
$config=readConfig();
$permissions=$config['permissions'];
$current_dir=$_SESSION['current_dir'];
$host=$_SESSION['host'];

// set header
header('Content-Type: charset=utf-8');
?>

<?php if ($_SERVER["REQUEST_METHOD"] == "GET"): ?>
    <?php 
        $file_path=$_GET['file'] ?? "config.json";

        // check permission
        if ($permissions['fileEditor'] !== true) {
            header('Location: /');
            exit;
        }

        // get content
        $file_content=file_get_contents($file_path);
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="stylesheet.css">
            <title>PHP drive Editor (wangEditor)</title>
        </head>
        <body>
            <?php echo $file_content; ?>
        </body>
    </html>

<?php endif; ?>