<?php

namespace App\Http\Controllers\EndUser;


use App\Models\Song;
use App\Services\CategoryService;
use App\Services\CloneService;
use App\Services\MasterService;
use App\Services\MusicService;
use App\Services\SongService;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpClient\HttpClient;
use Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\BaseMiddle;

class MusicController extends BaseController
{

    protected $musicService;

    protected $cloneService;

    protected $categoryService;
    protected $masterService;
    protected $songService;

    public function __construct(MusicService $musicService,
                                CloneService $cloneService,
                                CategoryService $categoryService,
                                SongService $songService,
                                MasterService $masterService )
    {
        $this->musicService = $musicService;
        $this->cloneService = $cloneService;
        $this->songService = $songService;
        $this->categoryService = $categoryService;
        $this->masterService = $masterService;
    }

    public function index(Request $request)
    {
        try {
            $songs = $this->songService->getSongsByViewDesc();
            $categories = $this->categoryService->getCategories();

//            $categorySong = $this->categoryService->getSongByCategory();

            return view('endUser.music.index', compact( 'categories', 'songs'));
        }catch (\Exception $exception) {
            dd($exception);
        }
    }

    public function musicDetail($slug)
    {
        try {

            $uuid = Helper::decodeUrlSong($slug);

            if (is_null($uuid) ) {
                return abort(404);
            }

            $song = $this->songService->getDetailByUuid($uuid);

            if (is_null($song) ){
                return abort(404);
            }

            $categoryId = $song->category_id;

            // set ex 5h
            $urlAudio = Storage::disk('vietmix')->temporaryUrl(
                $song->file_name, now()->addMinutes(300)
            );

            $songs = $this->songService->getListSongRelated($song->id, $categoryId);

//            $params['page'] = 10;
//            $songsNew = $this->musicService->getAll($params);

            $bg = $this->masterService->getAllImage()->pluck('url')->toArray();

            $bg = $bg[random_int(0, count($bg) - 1)];

            return view('endUser.music.detail', compact('urlAudio', 'songs', 'song', 'bg'));
        }catch (\Exception $exception) {
            dd($exception);
            return abort(404);
        }

    }
}
