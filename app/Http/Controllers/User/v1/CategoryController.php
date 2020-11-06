<?php

namespace App\Http\Controllers\User\v1;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Services\CategoryService;
use App\Services\SongService;
use Illuminate\Http\Request;

class CategoryController extends BaseControLler
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
        $uuid = Helper::getUuidOfCategory($slug);

        if (is_null($uuid)) {
//            return $this->success(null);
        }

        $categories = $this->categoryService->getFullCategories(['id', 'name', 'slug']);
        $category = $this->categoryService->getDetailByUuid($uuid);
        $songs = $this->songService->getSongByCategory($category->id);

        $data = [
            'category' => $category,
            'categories' => $categories,
            'songs' => $songs,
        ];
        return view('public.category.index', $data);
    }
}
