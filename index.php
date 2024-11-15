<?php
session_start();

// imports
require "config.php";
require "tool.php";

// set variable
$config=readConfig();
$permissions=$config['permissions'];
$root_dir=$config['rootFolder'];
$current_dir=$_GET['dir'] ?? $root_dir;
$host=$_SERVER['HTTP_HOST'];
$readme_file_path=$current_dir.'/README.md';

// read files
if (!is_dir($current_dir)) {
    mkdir($current_dir);
}
$files=scandir($current_dir);

// ban root visit
if (!is_have($current_dir, $root_dir) || is_have($current_dir, '..')) {
    header('Location: /');
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
        <title>PHP drive</title>
    </head>
    <body>
        
        <!-- upload form -->
        <?php if ($permissions['fileUpload'] === true): ?>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label>上传文件</label>
                <input type="file" name="file" id="file">
                <progress id="progress" value="0" max="100"></progress>
                <input type="submit" value="上传" id="fileUploadsubmit" hidden>
            </form>
            <script src="upload.js"></script>
        <?php endif; ?>
        <!-- upload form -->

        <!-- create file & folder form -->
        <div id="create_file_folder">
            <?php if ($permissions['folderCreate'] === true): ?>
                <form action="create_dir.php" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="新建文件夹" id="folderName" name="folderName" required>
                    <input type="submit" name="create" value="创建">
                </form>
            <?php endif; ?>
            <?php if ($permissions['folderCreate'] === true && $permissions['fileCreate'] === true): ?>
                &nbsp;&nbsp; || &nbsp;&nbsp;
            <?php endif; ?>
            <?php if ($permissions['fileCreate'] === true): ?>
                <form action="create_file.php" method="post" enctype="multipart/form-data">
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
                    <li>
                        <img src="/folder.gif">
                        <a href="?dir=<?php echo $path; ?>"><?php echo $file; ?></a>
                        <!-- if allow delete folder -->
                        <?php if ($permissions['folderDelete'] === true): ?>
                            &nbsp;[<a href="rmdirfile.php?dir=<?php echo $path; ?>">删除</a>]
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
                <!-- if file -->
                <?php if (is_file($path)): ?>
                    <li>
                        <img src="/file.gif">
                        <a href="<?php echo $path; ?>"><?php echo $file; ?></a>
                        <!-- if allow edit file & file not binary -->
                        <?php if ($permissions['fileEditor'] === true && is_binary($path) === false): ?>
                            &nbsp;[<a href="text_editor.php?file=<?php echo $path; ?>">编辑</a>]
                        <?php endif; ?>
                        <!-- if allow delete file -->
                        <?php if ($permissions['fileDelete'] === true): ?>
                            &nbsp;[<a href="rmdirfile.php?file=<?php echo $path; ?>">删除</a>]
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <!-- file list -->

        <!-- load README.md -->
        <?php if ($config['showREADME'] === true && file_exists($readme_file_path)): ?>
            <div id="README"></div>
            <script src="marked.min.js"></script>
            <script>
                const README_BOX = document.getElementById("README")
                README_BOX.innerHTML = marked.parse(`<?php echo get_readme_content($readme_file_path); ?>`);
            </script>
            <br>
        <?php endif; ?>
        <!-- load README.md -->

        <!-- up dir -->
        <?php if ($current_dir !== $root_dir): ?>
            <a href="?dir=<?php echo dirname($current_dir); ?>">返回上一级</a>
        <?php endif; ?>
        <!-- up dir -->

        <hr>

        <!-- admin panel link -->
        <a href="/admin-panel.php">进入管理面板</a>
        <!-- admin panel link -->

    </body>
</html>

<!-- set session -->
<?php
$_SESSION['root_dir']=$root_dir;
$_SESSION['current_dir']=$current_dir;
$_SESSION['host']=$host;
?>
<!-- set session -->