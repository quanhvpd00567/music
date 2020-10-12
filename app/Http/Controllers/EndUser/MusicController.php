<?php

namespace App\Http\Controllers\EndUser;


use App\Services\CategoryService;
use App\Services\CloneService;
use App\Services\MasterService;
use App\Services\MusicService;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Support\Facades\Cache;
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

    public function __construct(MusicService $musicService,
                                CloneService $cloneService,
                                CategoryService $categoryService,
                                MasterService $masterService )
    {
        $this->musicService = $musicService;
        $this->cloneService = $cloneService;
        $this->categoryService = $categoryService;
        $this->masterService = $masterService;
    }

    public function index(Request $request)
    {
        try {
            $params['page'] = 6;
            $songs = $this->musicService->getAll($params);

            $categorySong = $this->categoryService->getSongByCategory();

            return view('endUser.music.index', compact('songs', 'categorySong'));
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
            $music = $this->musicService->getMusicDetailByUuid($uuid);

            if (is_null($music) ){
                return abort(404);
            }

            $categoryId = $music->masterCategory->category->id;

            $client = new Client(HttpClient::create(['timeout' => 60]));
            $linkUpdate = Carbon::parse($music->link_updated_at)->format('Y-m-d');
            $currentDay = Carbon::now()->format('Y-m-d');
            $id = $music->id;
//            dd($id);
            if (Cache::has("music_$id")) {
                $urlAudio = Cache::get("music_$id");
            }else{
                if (!is_null($music->link_updated_at) && !is_null($music->link_mp3)) {
                    if ($linkUpdate == $currentDay) {
                        $urlUAudio = $music->link_mp3;
                        Cache::put("music_$id", $urlUAudio, Carbon::now()->endOfDay());
                    }else {
                        $urlAudio = $this->cloneService->cloneMp3FormNhacDj($client, $music, $currentDay);
                    }
                }else{
                    $urlAudio = $this->cloneService->cloneMp3FormNhacDj($client, $music, $currentDay);
                }
            }

            $songs = $this->musicService->getSongBySongIdAndCategory($categoryId, $music->id);

            $params['page'] = 10;
            $songsNew = $this->musicService->getAll($params);


            $bg = $this->masterService->getAllImage()->pluck('url')->toArray();

            $bg = $bg[random_int(0, count($bg) - 1)];


            return view('endUser.music.detail', compact('urlAudio', 'songs', 'songsNew', 'bg'));
        }catch (\Exception $exception) {
            dd($exception->getMessage());
            return abort(404);
        }

    }

}
