<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Helpers\Helper;
use App\Services\CategoryService;
use App\Services\MusicService;
use App\Services\SongService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{

    protected $categoryService;
    protected $musicService;
    protected $songService;
    public function __construct(CategoryService $categoryService, MusicService $musicService)
    {
        $this->categoryService = app(CategoryService::class);
        $this->musicService = app(MusicService::class);
        $this->songService = app(SongService::class);
    }

    public function categoryDetail($slug)
    {
        $uuid = Helper::getUuidOfCategory($slug);

        if (is_null($uuid)) {
            return abort(404);
        }

        $category = $this->categoryService->getDetailByUuid($uuid);
        if (is_null($category)) {
            return abort(404);
        }

        $songs = $this->songService->getSongByCategory($category->id);
        $params['page'] = 6;
        $songsNew = $this->songService->getSongRandom(15, null);

        return view('endUser.category.index', compact('songs', 'category', 'songsNew'));
    }
}
