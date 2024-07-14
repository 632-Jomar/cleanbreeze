<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    public function getFileExtension($file) {
        return ".{$file->getClientOriginalExtension()}";
    }

    public function filename($file, $prefix='') {
        return uniqid($prefix) . $this->getFileExtension($file);
    }

    public function filenameByDate($file, string $format = 'Y-m-d-H-i-u') {
        return now()->format($format) . $this->getFileExtension($file);
    }

    public function storeImage($folderName, $filename, $file) {
        Storage::disk('public')->putFileAs($folderName, $file, $filename);
    }

    public function deleteImage($folderName, $filename) {
        File::delete(public_path("storage/$folderName/$filename"));
    }

    public function updateImage($folderName, $oldFilename, $newFilename, $file) {
        $this->deleteImage($folderName, $oldFilename);
        $this->storeImage($folderName, $newFilename, $file);
    }

    public function saveImageBase64ToPng($folderName, $filename, $file, $prefix = '') {
        $this->deleteImage($folderName, $filename);

        $image     = str_replace('data:image/png;base64,', '', $file);
        $image     = str_replace(' ', '+', $image);
        $imageName = uniqid($prefix) .  '.png';

        Storage::disk('public')->put("$folderName/$imageName", base64_decode($image));

        return $imageName;
    }
}
