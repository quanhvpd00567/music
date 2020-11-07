<?php

namespace App\Http\Controllers\User\v1;

use App\Http\Controllers\Controller;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{

    protected $songService;

    public function __construct()
    {
        $this->songService = app(SongService::class);
    }

    public function listSongApproved()
    {
        $userId = Auth::user()->id;
        $songs = $this->songService->getSongByUserId($userId, 0);
        $active = 'approved';

        return view('public.user.songs', compact('songs', 'active'));
    }

    public function listSongInProgress()
    {
        $userId = Auth::user()->id;
        $songs = $this->songService->getSongByUserId($userId, 1);
        $active = 'in_progress';
        return view('public.user.songs', compact('songs', 'active'));
    }

    public function listSongCancel()
    {
        $userId = Auth::user()->id;
        $songs = $this->songService->getSongByUserId($userId, 2);
        $active = 'cancel';
        return view('public.user.songs', compact('songs', 'active'));
    }
}
