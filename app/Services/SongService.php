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
        if (isset($params['status']) &&  in_array($params['status'], array_values(Song::$status))) {
            $query = $query->where('status', $params['status']);
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
            $song->view                 = $params['view'] ?? random_int(80000, 376899);
            $song->liked                = $params['liked'] ?? random_int(40000, 80000);;
            $song->category_id          = $params['category_id'];
            $song->url                  = $params['file_name'];
            $song->image                = $params['image'];
            $song->user_id              = $params['user_id'] ?? null;
            $song->status               = $params['status'] ?? 0;
            $song->file_name            = $params['file_name'];
            $song->description          = $params['description'] ?? __('description.content', ['song_title' => $params['title']]);
            $song->is_set_link          = isset($params['is_set_link']) ? 0 : 1;
            $song->keyword              = $params['keyword']. ',vietmix.nv, vietmix, vietmix.vn dj';
            $song->save();
            return true;
        } catch (\Exception $exception) {
            dd($exception);
            return false;
        }

    }

    public function getDetail($id, $isStatus = false)
    {
        $query = $this->_songModel->where('id', $id);
        if($isStatus)
        {
            $query = $query->where('status', Song::$status['approved']);
        }
        return $query->first();
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
                'description'       => $params['description'] ?? __('description.content', ['song_title' => $params['title']]),
                'is_set_link'       => $params['is_set_link'],
                'view'              => $params['view'] ?? $song->view,
                'liked'             => $params['liked'] ?? $song->liked,
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
        return $this->_songModel->where('status', Song::$status['approved'])->orderBy('view', 'DESC')->limit(10)->get();
    }

    public function getDetailByUuid($uuid)
    {
        return $this->_songModel->where('uuid', $uuid)->where('status', Song::$status['approved'])->first();
    }

    public function getListSongRelated($songId, $categoryId)
    {
        return $this->_songModel->where('id', '<>', $songId)->where('status', Song::$status['approved'])->where('category_id', $categoryId)->orderby('id', 'DESC')->limit(10)->get();
    }

    public function getSongRandom($number = 10, $id = null)
    {
        $query = $this->_songModel->where('status', Song::$status['approved']);
        if (!is_null($id)) {
            $query = $query->where('id', '<>', $id);
        }
        return $query->inRandomOrder()->limit($number)->orderBy('id', 'DESC')->get();
    }

    public function searchSongsByParam($params)
    {
        $query = $this->_songModel->where('status', Song::$status['approved']);
        if (isset($params['tag'])) {
            $query = $query->where('keyword', 'LIKE' ,'%'. $params['tag'] . '%');
        }

        if (isset($params['keyword'])) {
            $query = $query->where('title', 'LIKE' ,'%'. $params['keyword'] . '%');
        }

        return $query->orderBy('id', 'DESC')->paginate(30);
    }

    public function getSongByCategory($categoryId)
    {
        $query = $this->_songModel->where('category_id', $categoryId)->where('status', Song::$status['approved']);

        return $query->orderBy('id', 'DESC')->paginate(30);
    }

    public function getSongByUserId($userId, $status = null)
    {
        $query = $this->_songModel->where('user_id', $userId);
        if (!is_null($status) || $status == 0) {
            $query = $query->where('status', $status);
        }
        return $query->orderBy('created_at', 'DESC')->paginate(30);
    }
}
