<?php

namespace App\Http\Controllers\User\v1;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\Helper;

class SongController extends BaseController
{
    protected $categoryService;
    protected $songService;

    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
        $this->songService = app(SongService::class);
    }

    public function detail($slug)
    {
        try {

            $uuid = Helper::decodeUrlSong($slug);

            if (is_null($uuid) ) {
                return $this->error404();
            }

            $song = $this->songService->getDetailByUuid($uuid);

            if (is_null($song) ){
                return $this->error404();
            }

            $categoryId = $song->category_id;

            // set ex 5h
            $urlAudio = Storage::disk('vietmix')->temporaryUrl(
                $song->file_name, now()->addMinutes(300)
            );
//            $urlAudio = 'https://s3.castbox.fm/61/9c/aa/d1de62472f906f8102e7f10003.mp3';

//            $songs = $this->songService->getListSongRelated($song->id, $categoryId);
//            $randomSongs = $this->songService->getSongRandom(10, $song->id);
            $categories = $this->categoryService->getFullCategories(['id', 'name', 'slug']);
            $data = [
                'urlAudio'      => $urlAudio,
                'song'          => $song,
                'categories'    => $categories
            ];

            return view('public.song.index', $data);
        }catch (\Exception $exception) {
            return $this->error404();
        }
    }
}
