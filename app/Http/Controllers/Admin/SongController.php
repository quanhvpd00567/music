<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SongRequest;
use App\Models\Song;
use App\Services\CategoryService;
use App\Services\fileService;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;

class SongController extends Controller
{

    protected $fileService;
    protected $categoryService;
    protected $songService;

    public function __construct(fileService $fileService, CategoryService $categoryService, SongService $songService)
    {
        $this->fileService = $fileService;
        $this->categoryService = $categoryService;
        $this->songService = $songService;
    }


    public function add()
    {
        $data = [
            'song' => new Song(),
            'listCategories' => $this->categoryService->getList()
        ];
        return view('admin.song.create', $data);
    }

    public function create(SongRequest $request)
    {
        try {
            $params = $request->only([
                'title', 'category_id', 'liked', 'view', 'author'
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $slugFile = Str::slug($request->title);
                $uuid = Uuid::generate(4)->string;
                $uuid = 'vietmix_' . str_replace('-', '_', $uuid);
                $pathFile = $this->fileService->updateFile($file, "$uuid.$extension");
                if ($pathFile != false) {
                    $params['path'] = $pathFile;
                    $params['slug'] = $slugFile;
                    $this->songService->createSong($params);
                    return abort(500);
                }
                return abort(401);
            }
        }catch (\Exception $exception) {
            dd($exception);
        }

//

//        dd($request);
    }
}
