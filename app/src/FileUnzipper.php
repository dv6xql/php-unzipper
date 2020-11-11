<?php

namespace app\src;

use ZipArchive;

class FileUnzipper
{
    public static function unzip(string $filePath, string $outputDirPath): string
    {
        if (!class_exists(ZipArchive::class)) {
            return Response::error('Class ZipArchive not found.');
        }

        $zip = new ZipArchive;

        if (!$zip->open($filePath)) {
            return Response::error("Could not read file {$filePath}");
        }

        if (!is_writeable($outputDirPath . '/')) {
            return Response::error("You do not have permission to write an output of {$filePath}");
        }

        $zip->extractTo($outputDirPath);
        $zip->close();

        return Response::success('Success! Unzipped.');
    }
}