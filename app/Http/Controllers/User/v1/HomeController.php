<?php

namespace App\Http\Controllers\User\v1;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
    }


    public function index()
    {
        return view('public.home.index');
    }
}
