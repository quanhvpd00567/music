<?php


namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class fileService
{
    protected $storage;
    const  AUDIO = 'vietmix';
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
            dd($exception);
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

    public function uploadAudio($audio, $name)
    {
        try {
            return Storage::disk('vietmix')->putFileAs(self::AUDIO, $audio, $name);
        } catch (\Exception $exception) {
            Log::error('Upload file failed: '. $exception);
            return false;
        }
    }
}
