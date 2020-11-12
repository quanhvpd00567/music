<?php


namespace App\Services;

use App\Imports\SongImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class fileService
{
    protected $storage;
    public function __construct()
    {
//        $this->storage = new Storage();
    }

    public function updateImage($file, $name)
    {
        try {
            return Storage::disk('vietmix')->putFileAs(env('IMAGE_STORAGE'), $file, $name, 'public');
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
            return Storage::disk('vietmix')->putFileAs(env('AUDIO_STORAGE'), $audio, $name, 'public');
        } catch (\Exception $exception) {
            Log::error('Upload file failed: '. $exception);
            return false;
        }
    }

    public function import($file)
    {
        return Excel::import(new SongImport(), $file);
    }

}
