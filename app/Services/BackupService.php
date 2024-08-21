<?php

namespace App\Services;

use ZipArchive;

class BackupService
{
    public function backupFolderToZip($folderPath, $zipFilePath)
    {
        // Membuat instance ZipArchive
        $zip = new ZipArchive;

        // Membuat file zip baru
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            // if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            // Menambahkan semua file dan folder dari folder ke dalam zip
            $this->addFolderToZip($folderPath, $zip, basename($folderPath));

            // Tutup file zip
            $zip->close();
            return true;
        } else {
            return false;
        }
    }

    private function addFolderToZip($folderPath, $zip, $parentFolder = '')
    {
        // Membuka direktori
        $dir = opendir($folderPath);

        // Menambahkan setiap file/folder ke dalam zip
        while ($file = readdir($dir)) {
            if ($file == '.' || $file == '..') continue;

            $filePath = $folderPath . '/' . $file;
            $relativePath = $parentFolder ? $parentFolder . '/' . $file : $file;

            if (is_dir($filePath)) {
                // Menambahkan folder ke dalam zip
                $this->addFolderToZip($filePath, $zip, $relativePath);
            } else {
                // Menambahkan file ke dalam zip
                $zip->addFile($filePath, $relativePath);
            }
        }

        closedir($dir);
    }
}
