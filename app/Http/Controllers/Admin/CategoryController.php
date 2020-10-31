<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryService;
    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
    }

    public function index()
    {
        $categories = $this->categoryService->getFullCategories();
        return view('admin.category.index', compact('categories'));
    }

    public function create(CategoryRequest $request)
    {
        $params = $request->only([
            'name', 'status'
        ]);

        $isSave = $this->categoryService->createCategory($params);

        if ($isSave) {
            return response(['status' => true], 200);
        }
        return response(['status' => false], 500);
    }

    public function edit($id)
    {
        $columns = ['id', 'name', 'status'];
        $category = $this->categoryService->getDetailById($id, $columns);
        if ($category) {
            return response(['status' => true, 'data' => $category], 200);
        }
        return response(['status' => false, 'data' => []], 500);
    }

    public function update(CategoryRequest $request)
    {
        try {
            $attrs = $request->only(['name', 'status', 'id']);
            $category = $this->categoryService->getDetailById($attrs['id']);
            if (is_null($category)) {
                return response(['status' => false], 404);
            }
            $isUpdate = $this->categoryService->updateCategory($attrs, $category);

            if ($isUpdate) {
                return response(['status' => true], 200);
            }
            return response(['status' => false], 500);
        } catch (\Exception $exception){
            dd($exception);
            return response(['status' => false], 500);
        }
    }
}
