<?php


namespace App\Http\Composer;

use App\Services\CategoryService;
use Illuminate\View\View;

class CategoryComposer
{
    protected $_categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->_categoryService = $categoryService;
    }

    public function compose(View $view)
    {
        $view->with('categories', $this->_categoryService->getFullCategories());
    }
}
