<?php


namespace App\Services;


use App\Http\Helpers\Helper;
use App\Models\Song;
use Illuminate\Support\Facades\DB;

class SongService
{
    protected $_songModel;
    public function __construct(Song $song)
    {
        $this->_songModel = $song;
    }

    public function getList($params = [])
    {
        $query = $this->_songModel;
        if (isset($params['title'])) {
            $query = $query->where('title', 'LIKE', '%'. $params['title']. '%');
        }

        if (isset($params['category']) && $params['category'] != 0) {
            $query = $query->where('category_id', $params['category']);
        }

        return $query->orderBy('id', 'DESC')->paginate($params['page']);
    }

    public function createSong($params)
    {
        try {
            $song = new Song();
            $song->title                = $params['title']. ' - vietmix.vn';
            $song->author               = $params['author'] ?? 'vietmix.vn DJ';
            $uuid                       = Helper::getUuid();
            $song->slug                 = $params['slug']. '-'. $uuid;
            $song->uuid                 = $uuid;
            $song->view                 = $params['view'] ?? random_int(40000, 376899);
            $song->liked                = $params['liked'] ?? random_int(40000, 376899);;
            $song->category_id          = $params['category_id'];
            $song->url                  = $params['file_name'];
            $song->image                = $params['image'];
            $song->file_name            = $params['file_name'];
            $song->description          = $params['description'];
            $song->keyword              = $params['keyword']. ',vietmix.nv, vietmix, vietmix.vn dj';
            $song->save();
            return true;
        } catch (\Exception $exception) {
            return false;
        }

    }

    public function getDetail($id)
    {
        return $this->_songModel->where('id', $id)->first();
    }

    public function update($params, $id)
    {
        try {
            DB::beginTransaction();
            $song = $this->getDetail($id);
            $dataUpdate = [
                'title'             => $params['title'],
                'author'            => $params['author'] ?? 'vietmix.vn DJ',
                'slug'              => $params['slug']. '-'. $song->uuid,
                'image'             => $params['image'],
                'file_name'         => $params['file_name'],
                'keyword'           => $params['keyword'],
                'url'               => $params['file_name'],
                'category_id'       => $params['category_id'],
                'description'       => $params['description'],
                'view'              => $params['view'] ?? random_int(40000, 376899),
                'liked'             => $params['liked'] ?? random_int(40000, 376899),
            ];
            $this->_songModel->where('id', $id)->update($dataUpdate);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

    public function getSongsByViewDesc()
    {
        return $this->_songModel->orderBy('view', 'DESC')->limit(10)->get();
    }

    public function getDetailByUuid($uuid)
    {
        return $this->_songModel->where('uuid', $uuid)->first();
    }

    public function getListSongRelated($songId, $categoryId)
    {
        return $this->_songModel->where('id', '<>', $songId)->where('category_id', $categoryId)->orderby('id', 'DESC')->limit(10)->get();
    }

}