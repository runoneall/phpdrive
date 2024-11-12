<?php

function is_binary($filename) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $filename);
    finfo_close($finfo);
    return strpos($mime_type, 'text') === false;
}

?>