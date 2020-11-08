<?php

namespace App\Http\Controllers\User\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadSongRequest;
use App\Models\Song;
use App\Models\User;
use App\Services\CategoryService;
use App\Services\fileService;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\Helper;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;

class SongController extends BaseController
{
    protected $categoryService;
    protected $songService;
    protected $fileService;

    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
        $this->songService = app(SongService::class);
        $this->fileService = app(fileService::class);
    }

    public function detail($slug)
    {
        $isMobile = $this->isMobile();
        try {

            $uuid = Helper::decodeUrlSong($slug);

            if (is_null($uuid) ) {
                return $this->error404();
            }

            $song = $this->songService->getDetailByUuid($uuid);

            if (is_null($song) ){
                return $this->error404();
            }

            if ($song->is_set_link == Song::$setLink['yes']) {
                $urlAudio = $song->$song->file_name;
            } else {
                // set ex 5h
                $urlAudio = Storage::disk('vietmix')->temporaryUrl(
                    $song->file_name, now()->addMinutes(300)
                );
            }

//            $categoryId = $song->category_id;

//            $songs = $this->songService->getListSongRelated($song->id, $categoryId);
//            $randomSongs = $this->songService->getSongRandom(10, $song->id);
            $categories = $this->categoryService->getFullCategories(['id', 'name', 'slug']);
            $data = [
                'urlAudio'      => $urlAudio,
                'song'          => $song,
                'categories'    => $categories,
                'isMobile'      =>$isMobile
            ];

            return view('public.song.index', $data);
        }catch (\Exception $exception) {
            return $this->error404();
        }
    }

    public function uploadFile()
    {
        $song = new Song();
        $listCategories = $this->categoryService->getList();
        return view('public.user.upload', compact('song', 'listCategories'));
    }

    public function uploadFilePost(UploadSongRequest $request)
    {
        try {
            $params = $request->only([
                'title', 'keyword', 'author', 'description', 'category_id'
            ]);

            if ($request->hasFile('image') && $request->hasFile('file')) {
                $fileImage = $request->image;

                $fileAudio = $request->file;

                $extension = $fileImage->getClientOriginalExtension();

                $extensionAudio = $fileAudio->getClientOriginalExtension();
                $slugFile = Str::slug($params['title']);
                $uuid = Uuid::generate(1)->node;
                $fileImage = $slugFile . '-' . $uuid;
                $pathFileImage = $this->fileService->updateImage($request->image, "$fileImage.$extension");
                if (!$pathFileImage) {
                    return abort(500);
                }
                $fileAudio = $fileImage;
                $pathFileAudio = $this->fileService->uploadAudio($request->file, "$fileAudio.$extensionAudio");

                if (is_string($pathFileImage) && is_string($pathFileAudio)) {
                    $params['image'] = 'https://www.vietmix.vn/' . $pathFileImage;
                    $params['slug'] = $slugFile;
                    $params['liked'] = 0;
                    $params['view'] = 0;
                    $params['file_name'] = $pathFileAudio;
                    $params['user_id'] = Auth::user()->role == User::$roles['member'] ? Auth::user()->id : null;
                    $params['status'] = Song::$status['pending'];
                    $isSave = $this->songService->createSong($params);
                    if ($isSave) {
                        return redirect()->route('user.songs');
                    }
                }
                return $this->error500();
            }
        } catch (\Exception $exception) {
            return $this->error500();
        }
    }

    public function search(Request $request)
    {
        $params = $request->only(['tag', 'keyword']);
        $songs = $this->songService->searchSongsByParam($params);
        return view('public.song.search', compact('songs'));
    }
}
