<?php

namespace app\src;

class DirectoryManager
{
    public static function removeFile(string $filePath): array
    {
//        if (file_exists($filePath)) {
//            return Response::error("Could not find a file {$filePath}.");
//        }

        unlink($filePath);

        return Response::success("File has been removed.");
    }
}