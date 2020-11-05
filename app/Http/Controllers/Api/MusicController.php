<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SongService;
use Illuminate\Http\Request;

class MusicController extends BaseController
{

    protected $songService;
    public function __construct()
    {
        $this->songService = app(SongService::class);
    }

    public function getListSong()
    {
        try {
            $data = $this->songService->getSongRandom();
            return $this->success($data);
        } catch (\Exception $exception) {
            return $this->error('loi roi');
        }
    }
    public function detail()
    {
        $url = 'https://vietmix.sfo2.digitaloceanspaces.com/vietmix/Happy-Halloween-2020.mp3?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=UP2UQPISVMARUXVN7H4Q%2F20201105%2Fsfo2%2Fs3%2Faws4_request&X-Amz-Date=20201105T175354Z&X-Amz-SignedHeaders=host&X-Amz-Expires=18000&X-Amz-Signature=6542ef1e0a392992d91ddc7b1bd6d3b95e7e871c5ced0a2032c9c02ab696d6aa';
        return $this->success(['url' => $url]);
    }
}
