<?php

function is_binary($filename) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $filename);
    finfo_close($finfo);
    return strpos($mime_type, 'text') === false;
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