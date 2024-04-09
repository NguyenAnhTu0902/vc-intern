<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    //Saves an uploaded image to the specified disk and path.
    /**
     * @param $file
     * @param string $path
     * @return string
     */
    public static function saveImage($file, string $path): string
    {
        $fileName = rand(1111, 9999) . time() . $file->getClientOriginalName();
        $imagePath = $path . DIRECTORY_SEPARATOR . $fileName;
        try {
            Storage::disk('public')->put($imagePath, file_get_contents($file));
        } catch (\Exception $e) {
            throw new \RuntimeException("Failed to save image: {$e->getMessage()}");
        }

        return $fileName;
    }

    //Deletes an image from the specified disk and path.
    /**
     * @param string $fileName
     * @param string $path
     * @return bool
     */
    public static function deleteImage(string $fileName, string $path): bool
    {
        if (Storage::disk('public')->exists($path . DIRECTORY_SEPARATOR . $fileName)) {
            return Storage::disk('public')->delete($path . DIRECTORY_SEPARATOR . $fileName);
        }

        return false;
    }

}
