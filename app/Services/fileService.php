<?php


namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class fileService
{
    protected $storage;
    const  FOLDER = 'vietmix';
    const  IMAGE = 'images';
    public function __construct()
    {
//        $this->storage = new Storage();
    }

    public function updateImage($file, $name)
    {
        try {
            return Storage::disk('vietmix')->putFileAs(self::IMAGE, $file, $name, 'public');
        } catch (\Exception $exception) {
            Log::error('Upload file failed: '. $exception);
            return false;
        }
    }

    public function deleteImage($file)
    {
        try {
            return Storage::disk('vietmix')->delete($file);
        } catch (\Exception $exception) {
            Log::error('Delete file failed: '. $exception);
            return false;
        }
    }
}
