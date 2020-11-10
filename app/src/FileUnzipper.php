<?php

namespace app\src;

use ZipArchive;

class FileUnzipper
{
    public static function unzip(string $filePath, string $outputDirPath): array
    {
        if (!class_exists(ZipArchive::class)) {
            return [
                'success' => 0,
                'message' => 'Class ZipArchive not found.'
            ];
        }

        $zip = new ZipArchive;

        if (!$zip->open($filePath)) {
            return [
                'success' => 0,
                'message' => "Could not read file {$filePath}"
            ];
        }

        if (!is_writeable($outputDirPath . '/')) {
            return [
                'success' => 0,
                'message' => "You do not have permission to write an output of {$filePath}"
            ];
        }

        $zip->extractTo($outputDirPath);
        $zip->close();

        return [
            'success' => 1,
            'message' => 'Success'
        ];
    }
}