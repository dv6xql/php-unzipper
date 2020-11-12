<?php

namespace app\src;

class DirectoryScanner
{
    const TYPE_DIRS = 'dirs';
    const TYPE_FILES = 'files';
    const DEFAULT_FILE_EXTENSIONS = ['zip'];

    protected $dirPath;

    public function __construct(string $dirPath)
    {
        $this->dirPath = $dirPath;
    }

    public function getDirPath(): string
    {
        return $this->dirPath;
    }

    public function scanDir(?string $filterByType = null): array
    {
        $items = scandir($this->dirPath);
        $output = [
            self::TYPE_DIRS => [],
            self::TYPE_FILES => []
        ];

        foreach ($items as $item) {
            if (in_array($item, ['.', '..'])) {
                continue;
            }

            $path = "{$this->dirPath}/{$item}";
            $type = is_dir($path) ? self::TYPE_DIRS : self::TYPE_FILES;

            $output[$type][] = $path;
            ksort($output[$type]);
        }

        if (!is_null($filterByType) && in_array($filterByType, [self::TYPE_DIRS, self::TYPE_FILES])) {
            return $output[$filterByType];
        }

        return Response::success("Success! Directory scanned.", $output);
    }

    public function findFiles(array $extensions = self::DEFAULT_FILE_EXTENSIONS): array
    {
        $items = $this->scanDir(self::TYPE_FILES);
        $output = [];

        foreach ($items as $item) {
            if (count($extensions) && !in_array(pathinfo($item, PATHINFO_EXTENSION), $extensions)) {
                continue;
            }
            $output[] = $item;
        }

        return Response::success("Success! Files found.", $output);
    }
}