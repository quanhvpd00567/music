<?php


namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;

class CategoryService
{
    protected $_modalCategory;
    public function __construct()
    {
        $this->_modalCategory = app(Category::class);
    }

    public function getList()
    {
        return $this->_modalCategory->pluck('name', 'id')->toArray();
    }
    public function getFullCategories($column = ['*'])
    {
        return $this->_modalCategory->select($column)->withCount('songs')->get();
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
        return $query->get();
    }


    public function getCategories()
    {
        return $this->_modalCategory->with(['songs' => function($query) {
            $query->limit(6);
        }])->get();
    }

    public function createCategory($params)
    {
        try {
            $uuid = Uuid::generate(1)->node;
            $params['slug'] = Str::slug($params['name']). '-' . $uuid;
            $params['status'] = $params['status'] == 'true' ? 1 : 0;
            $params['uuid'] = $uuid;
            return $this->_modalCategory->create($params);
        }catch (\Exception $exception) {
            return false;
        }
    }

    public function getDetailById($id, $columns = ['*'])
    {
        return $this->_modalCategory->where('id', $id)->select($columns)->first();
    }

    public function updateCategory($attrs, $category)
    {
        $uuid = $category->uuid;
        $attrs['slug'] = Str::slug($attrs['name']). '-' . $uuid;
        $attrs['status'] = $attrs['status'] == 'true' ? 1 : 0;
        return $this->_modalCategory->where('id', $category->id)->update($attrs);
    }

    public function getDetailByUuid($uuid)
    {
        return $this->_modalCategory->where('uuid', $uuid)->first();
    }
}
