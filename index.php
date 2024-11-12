<?php
session_start();
require "source/config.php";

// set variable
$config=readConfig();
$root_dir=$config['rootFolder'];
