<?php

require "src/DirectoryScanner.php";
use app\src\DirectoryScanner;

$dirPath = dirname(__FILE__) . "/public";

echo "PHP Unzipper";
echo "{$dirPath}";

$directory = new DirectoryScanner($dirPath);
$files1 = $directory->scanDir();
print_r($files1);
