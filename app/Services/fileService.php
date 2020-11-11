<?php


namespace App\Services;

use App\Imports\SongImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


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
            return Storage::disk('vietmix')->putFileAs('dev_images', $file, $name, 'public');
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

    public function uploadAudio($audio, $name)
    {
        try {
            return Storage::disk('dev_songs')->putFileAs(self::AUDIO, $audio, $name, 'public');
        } catch (\Exception $exception) {
            Log::error('Upload file failed: '. $exception);
            return false;
        }
    }

    public function import($file)
    {
        Excel::import(new SongImport(), $file);
    }

}
