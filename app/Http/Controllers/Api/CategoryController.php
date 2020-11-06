<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $categoryService;
    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
    }

    public function getList()
    {
        $data = $this->categoryService->getFullCategories(['id', 'name', 'slug']);
        return $this->success($data);
    }

    public function getDetailByUuid($slug)
    {
        $uuid = Helper::getUuidOfCategory($slug);

        if (is_null($uuid)) {
            return $this->success(null);
        }

        $category = $this->categoryService->getDetailByUuid($uuid);
        return $this->success($category);
    }
}
