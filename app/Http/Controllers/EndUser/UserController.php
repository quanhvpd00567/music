<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadSongRequest;
use App\Models\Song;
use App\Models\User;
use App\Services\CategoryService;
use App\Services\fileService;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;

class UserController extends Controller
{

    protected $fileService;
    protected $categoryService;
    protected $songService;

    public function __construct()
    {
        $this->fileService = app(fileService::class);
        $this->categoryService = app(CategoryService::class);
        $this->songService = app(SongService::class);
    }


    public function uploadFile()
    {
        $song = new Song();
        $listCategories = $this->categoryService->getList();

        return view('endUser.user.upload', compact('song', 'listCategories'));
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
                return abort(500);
            }
        } catch (\Exception $exception) {
            return abort(500);
        }
    }

    public function listSong()
    {
        $userId = Auth::id();
        $approvedSongs = $this->songService->getSongByUserId($userId, 0);
        $pendingSongs = $this->songService->getSongByUserId($userId, 1);
        $rejectSongs = $this->songService->getSongByUserId($userId, 2);
        return view('endUser.user.songs', compact('approvedSongs', 'pendingSongs', 'rejectSongs'));
    }
}
