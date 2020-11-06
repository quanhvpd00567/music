<?php

namespace App\Http\Controllers\User\v1;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class HomeController extends BaseControLler
{
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
    }


    public function index()
    {
        $categories = $this->categoryService->getFullCategories(['id', 'name', 'slug']);
        return view('public.home.index', compact('categories'));
    }
}
