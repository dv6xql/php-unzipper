<?php

require "src/DirectoryScanner.php";
use app\src\DirectoryScanner;

echo "PHP Unzipper";

$directory = new DirectoryScanner(__FILE__);
$files1 = $directory->scanDir();
print_r($files1);
