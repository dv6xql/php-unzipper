<?php

namespace app\src;

class DirectoryScanner
{
    const TYPE_DIRS = 'dirs';
    const TYPE_FILES = 'files';

    protected $dirPath;

    public function __construct(string $dirPath)
    {
        $this->dirPath = $dirPath;
    }

    public function getDirPath(): string
    {
        return $this->dirPath;
    }

    public function scanDir(): array
    {
        $items = scandir($this->dirPath);
        $output = [];

        foreach ($items as $item) {
            if (in_array($item, ['.', '..'])) {
                continue;
            }

            $type = is_dir("{$this->dirPath}/{$item}") ? self::TYPE_DIRS : self::TYPE_FILES;

            $output[$type][] = $item;
            ksort($output[$type]);
        }

        return $output;
    }
}