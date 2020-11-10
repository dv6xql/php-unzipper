<?php

echo "PHP Unzipper";

class DirectoryScanner
{
    protected $dirPath;

    public function __construct(string $filePath)
    {
        $this->dirPath = dirname($filePath);
    }

    public function getDirPath(): string
    {
        return $this->dirPath;
    }

    public function scanDir(): array
    {
        $files = scandir($this->dirPath);
        $output = [];

        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            $output[] = $file;
        }

        return $output;
    }
}

$directory = new DirectoryScanner(__FILE__);
$files1 = $directory->scanDir();
print_r($files1);
