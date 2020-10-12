<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\MusicService;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;

class MusicController extends Controller
{

    protected $musicService;
    protected $categoryService;

    public function __construct(MusicService $musicService, CategoryService $categoryService)
    {
        $this->musicService = $musicService;
        $this->categoryService = $categoryService;
    }

    public function getAll(Request $request)
    {
        $songs = $this->musicService->getAll($request);
        $params = $request->only([
           'name', 'category'
        ]);
        $currentPage = isset($request['page']) ? $request['page'] : 1;
        $categories = [0 => 'All'];
        $categories = array_merge($categories, $this->categoryService->getList());
        $index = ($currentPage * 15) - 15 + 1;
        return view('admin.music.index', compact('songs', 'params', 'index', 'categories'));
    }
}
