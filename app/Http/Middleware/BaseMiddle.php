<?php

namespace App\Http\Middleware;

use App\Services\CategoryService;
use Closure;
use Illuminate\Http\Request;

class BaseMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $_categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->_categoryService = $categoryService;
    }

    public function handle(Request $request, Closure $next)
    {
        $categories = $this->_categoryService->getFullCategories();
        return $next($categories);
    }
}
