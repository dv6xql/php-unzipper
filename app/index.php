<?php

require "src/DirectoryScanner.php";
require "src/FileUnzipper.php";

use app\src\DirectoryScanner;
use app\src\FileUnzipper;

$dirPath = dirname(__FILE__) . "/public";

$directory = new DirectoryScanner($dirPath);
$dirFiles = $directory->findFiles();

if (isset($_POST['unzip'])) {
    $fileUnzipper = new FileUnzipper();

    $archive = isset($_POST['zipfile']) ? strip_tags($_POST['zipfile']) : '';
    $filePath = "{$directory->getDirPath()}/{$archive}";

    $fileUnzipper::unzip($filePath, $directory->getDirPath());
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Unzipper</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@latest/dist/tailwind-ui.min.css">
</head>
<body>

<div>
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8" src="https://tailwindui.com/img/logos/v1/workflow-mark-on-dark.svg" alt="Workflow logo">
                    </div>
                    <div class="md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Unzipper</a>

                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Team</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </nav>

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                PHP Unzipper
            </h1>

            <p><?php echo $dirPath ?></p>

        </div>
    </header>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Replace with your content -->
            <div class="px-4 py-6 sm:px-0">
                <div class="rounded-lg h-96">

                    <form class="w-full max-w-lg" action="" method="POST">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                    Files
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-state" name="zipfile">
                                        <?php foreach($dirFiles as $file): ?>
                                            <option><?php echo $file ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full px-3">
                                <button type="submit" name="unzip" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                    Unzip
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /End replace -->
        </div>
    </main>
</div>

</body>
</html>

