<?php

namespace app\src;

class DirectoryManager
{
    public static function removeDirectory(string $dirPath): array
    {
        $items = scandir($dirPath);

        foreach ($items as $item) {
            if ($item == "." || $item == "..") {
                continue;
            }

            if (filetype($dirPath . "/" . $item) == "dir") {
                rmdir($dirPath . "/" . $item);
            } else {
                unlink($dirPath . "/" . $item);
            }
        }

        reset($objects);
        rmdir($dirPath);

        return Response::success("Directory has been removed.");
    }

    public static function removeFile(string $filePath): array
    {
//        if (file_exists($filePath)) {
//            return Response::error("Could not find a file {$filePath}.");
//        }

        unlink($filePath);

        return Response::success("File has been removed.");
    }
}