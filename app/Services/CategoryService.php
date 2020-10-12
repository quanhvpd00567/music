<?php


namespace App\Services;

use App\Models\Category;
class CategoryService
{
    protected $_modalCategory;
    public function __construct(Category $category)
    {
        $this->_modalCategory = $category;
    }

    public function getList()
    {
        return $this->_modalCategory->pluck('name', 'id')->toArray();
    }
    public function getFullCategories()
    {
        return $this->_modalCategory->all();
    }

    public function getDetail($id)
    {
        return $this->_modalCategory->where('id', $id)->with('masterCategories.music')->first();
    }

    public function getSongByCategory($params = [])
    {
        $query = $this->_modalCategory->with(['masterCategories.music' => function($q) use ($params) {
            if (isset($params['songId'])){
                $q->where('id', '<>' , $params['songId']);
            }
            $q->orderBy('id', 'DESC');
        }]);

        if (isset($params['id'])){
            $query = $query->where('categories.id', '=' , $params['id']);
        }

//        dd();

        return $query->get();
    }





}
