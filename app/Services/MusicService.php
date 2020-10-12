<?php


namespace App\Services;


use App\Models\Music;

class MusicService
{
    protected $_musicModel;

    public function __construct(Music $music)
    {
        $this->_musicModel = $music;
    }

    public function getMusicDetail($id)
    {
        return $this->_musicModel->where('id', $id)->with('masterCategory.category')->first();
    }

    public function getMusicDetailByUuid($uuid)
    {
        return $this->_musicModel->where('uuid', $uuid)->with('masterCategory.category')->first();
    }

    public function getAll($params = [])
    {
        $query = $this->_musicModel
            ->select(
                [
                    'music.name as music_name',
                    'music.*',
                ]
            )
            ->join('master_categories', 'master_categories.id', '=', 'music.master_category_id')
            ->join('categories', 'categories.id', '=', 'master_categories.category_id')
            ->with('masterCategory.category', 'masterCategory.masterSite');

        // Params has status
        if (isset($params['status'])) {
            $query = $query->where('status', $params['status']);
        }

        // Params has name
        if (isset($params['name'])) {
            $query = $query->where('music.name', 'LIKE', $params['name'] . '%');
        }

        // Params has category clone
//        dd($params['category']);
        if (isset($params['category']) && $params['category'] != '0') {
            $query = $query->where('master_categories.category_id', $params['category']);
        }

        $perPage = isset($params['page']) ? $params['page'] : 15;

        return $query->orderBy('music.id', 'DESC')->paginate($perPage);

    }

    public function getAllNew($idCategory)
    {
        return $this->_musicModel
            ->join('master_categories', 'music.master_category_id', '=', 'master_categories.id')
            ->join('categories', 'master_categories.category_id', '=', 'categories.id')
            ->where('categories.id', $idCategory)
            ->orderBy('music.id', 'DESC')
            ->select('music.*')->paginate(30);
    }

    public function getSongBySongIdAndCategory($idCategory, $songId)
    {
        return $this->_musicModel
            ->join('master_categories', 'music.master_category_id', '=', 'master_categories.id')
            ->join('categories', 'master_categories.category_id', '=', 'categories.id')
            ->where('categories.id', $idCategory)
            ->where('music.id', '<>', $songId)
            ->select('music.*')
            ->orderBy('music.id', 'DESC')
            ->limit(10)->get();
    }

}
