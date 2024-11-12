<?php

function readConfig() {
    $configString = file_get_contents($_SERVER['DOCUMENT_ROOT']."/source/config.json");
    $config = json_decode($configString, true);
    return $config;
}

function writeConfig($config) {
    $configString = json_encode($config);
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/source/config.json", $configString);
}

?>