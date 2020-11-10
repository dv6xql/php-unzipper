<?php

require "src/DirectoryScanner.php";
require "src/FileUnzipper.php";

use app\src\DirectoryScanner;
use app\src\FileUnzipper;

$dirPath = dirname(__FILE__) . "/public";

$directory = new DirectoryScanner($dirPath);
$dirFiles = $directory->findFiles();

if (isset($_POST['actionUnzip'])) {
    $fileUnzipper = new FileUnzipper();

    $fileName = isset($_POST['zipFile']) ? strip_tags($_POST['zipFile']) : '';
    $filePath = "{$directory->getDirPath()}/{$fileName}";
    $fileUnzipper::unzip($filePath, $directory->getDirPath());
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Unzipper</title>
</head>
<body>

<div>
    <main>

        <form action="" method="POST">

            <select name="zipFile">
                <?php foreach ($dirFiles as $file): ?>
                    <option><?php echo $file ?></option>
                <?php endforeach ?>
            </select>

            <button type="submit" name="actionUnzip">
                Unzip
            </button>

        </form>

    </main>
</div>

</body>
</html>

