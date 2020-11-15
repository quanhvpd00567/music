<?php

namespace App\Http\Controllers\User\v1;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\SongService;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    protected $categoryService;
    protected $songService;

    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
        $this->songService = app(SongService::class);
    }


    public function index()
    {
        $songs = $this->songService->getSongRandom(50);
        return view('public.home.index', compact('songs'));
    }
}
