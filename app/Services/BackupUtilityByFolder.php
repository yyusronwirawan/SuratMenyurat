<?php

namespace App\Services;

use ZipArchive;
use Illuminate\Support\Facades\Storage;

class BackupUtilityByFolder
{
    /**
     * Backup specified folders into a zip file.
     *
     * @param  array  $folderNames
     * @return string|null
     */
    public function backupFolders(array $folderNames)
    {
        $zipFileName = 'backup_' . now()->format('YmdHis') . '.zip';
        $zipFilePath = public_path($zipFileName);

        $zip = new ZipArchive();

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return null;
        }

        foreach ($folderNames as $folderName) {
            $folderPath = public_path("file/" . $folderName);
            if (is_dir($folderPath)) {
                $this->addFolderToZip($zip, $folderPath, $folderName);
            }
        }

        $zip->close();

        return $zipFileName;
    }

    /**
     * Add a folder and its contents to the zip archive.
     *
     * @param  ZipArchive  $zip
     * @param  string  $folderPath
     * @param  string  $parentFolder
     * @return void
     */
    protected function addFolderToZip(ZipArchive $zip, string $folderPath, string $parentFolder)
    {
        if ($handle = opendir($folderPath)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry == '.' || $entry == '..') {
                    continue;
                }

                $path = $folderPath . '/' . $entry;
                $relativePath = $parentFolder . '/' . $entry;

                if (is_file($path)) {
                    $zip->addFile($path, $relativePath);
                } elseif (is_dir($path)) {
                    $this->addFolderToZip($zip, $path, $relativePath);
                }
            }
            closedir($handle);
        }
    }
}
