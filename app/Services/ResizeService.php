<?php


namespace App\Services;


use Intervention\Image\Facades\Image;

/**
 * Сервис ресайза.
 */
class ResizeService
{
    /**
     * Ресайз.
     *
     * @param string $fileName
     * @return string
     */
    public function resize(string $fileName): string
    {
        $storagePathPreview = storage_path('app/files/news/preview_' . $fileName);
        $storagePath = storage_path('app/files/news/' . $fileName);

        if (!file_exists($storagePathPreview)) {
            $img = Image::make($storagePath);
            $img->resize(200, 250);
            $img->save($storagePathPreview);
        }

        return $storagePathPreview;
    }
}
