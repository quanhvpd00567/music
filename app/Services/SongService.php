<?php


namespace App\Services;


use App\Http\Helpers\Helper;
use App\Models\Song;

class SongService
{
    protected $_songModel;
    public function __construct(Song $song)
    {
        $this->_songModel = $song;
    }

    public function createSong($params)
    {
        try {

            $song = new Song();
            $song->title = $params['title'];
            if (isset($params['author']) && !empty($params['author'])) {
                $song->author = $params['author'];
            }
            $uuid = Helper::getUuid();
            $song->slug = $params['slug']. '-'. $uuid;
            $song->uuid = $uuid;
            $song->view = $params['view'];
            $song->liked = $params['liked'];
            $song->category_id = $params['category_id'];
            $song->url = $params['path'];
            $song->file_name = $params['path'];
            $song->save();
            return true;
        } catch (\Exception $exception) {
            dd($exception);
            return false;
        }

    }
}
