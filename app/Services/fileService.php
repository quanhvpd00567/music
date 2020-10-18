<?php


namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class fileService
{
    protected $storage;
    const  FOLDER = 'vietmix';
    public function __construct()
    {
//        $this->storage = new Storage();
    }

    public function checkExists()
    {
//        Storage::disk('vietmix')->
    }

    public function updateFile($file, $name)
    {
        try {
            return Storage::disk('vietmix')->putFileAs(self::FOLDER, $file, $name);
        } catch (\Exception $exception) {
            Log::error('Upload file failed: '. $exception);
            return false;
        }
    }
}
