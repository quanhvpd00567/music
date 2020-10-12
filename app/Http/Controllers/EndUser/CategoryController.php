<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Helpers\Helper;
use App\Services\CategoryService;
use App\Services\MusicService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{

    protected $categoryService;
    protected $musicService;
    public function __construct(CategoryService $categoryService, MusicService $musicService)
    {
        $this->categoryService = $categoryService;
        $this->musicService = $musicService;
    }

    public function categoryDetail($slug)
    {
        $id = Helper::decodeUrlCategory($slug);
        if (is_null($id)) {
            return abort(404);
        }

        $category = $this->categoryService->getDetail($id);
        if (is_null($category)) {
            return abort(404);
        }

        $songs = $this->musicService->getAllNew($id);
        $params['page'] = 6;
        $songsNew = $this->musicService->getAll($params);

        return view('endUser.category.index', compact('songs', 'category', 'songsNew'));
    }
}
