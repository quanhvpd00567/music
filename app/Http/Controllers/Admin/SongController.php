<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SongRequest;
use App\Models\Song;
use App\Services\CategoryService;
use App\Services\fileService;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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

    public function index(Request $request)
    {
        $params = $request->only([
            'title', 'category'
        ]);
        $currentPage = isset($request['page']) ? $request['page'] : 1;
        $page = 15;
        $index = ($currentPage * $page) - $page + 1;
        $params['page'] = $page;
        $songs = $this->songService->getList($params);
        $categoriesAdmin = [0 => 'All'];
        $categoriesAdmin = array_merge($categoriesAdmin, $this->categoryService->getList());
        return view('admin.song.index', compact('songs', 'index', 'categoriesAdmin', 'params'));
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
                'title', 'category_id', 'liked', 'view', 'author', 'file_name', 'keyword', 'description', 'is_set_link'
            ]);
            $paramsUpdate['is_set_link'] = isset($paramsUpdate['is_set_link']) ? 1 : 0;
            if ($request->hasFile('image')) {
                $file = $request->image;
                $extension = $file->getClientOriginalExtension();
                $slugFile = Str::slug($params['title']);
                $uuid = Uuid::generate(4)->string;
                $fileImage = $slugFile . '-' . $uuid;
                $pathFile = $this->fileService->updateImage($file, "$fileImage.$extension");
                if ($pathFile != false) {
                    $params['image'] = 'https://media.vietmix.vn/'. $pathFile;
                    $params['slug'] = $slugFile;
                    $isSave = $this->songService->createSong($params);
                    if ($isSave) {
                        return \redirect()->route('song.list');
                    }
                }
                return abort(500);
            }
        }catch (\Exception $exception) {
            return abort(401);
        }
    }

    public function edit($id)
    {
        $song = $this->songService->getDetail($id);
        $data = [
            'song' => $song,
            'listCategories' => $this->categoryService->getList()
        ];
        return view('admin.song.edit', $data);
    }

    public function update($id, SongRequest $request)
    {
        $paramsUpdate = $request->only([
            'title', 'author', 'view', 'liked', 'file_name', 'category_id', 'keyword', 'description', 'is_set_link'
        ]);

        $paramsUpdate['is_set_link'] = isset($paramsUpdate['is_set_link']) ? 1 : 0;

        $song = $this->songService->getDetail($id);

        $slugFile = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpg,png,jpeg',
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $uuid = Uuid::generate(4)->string;
            $fileImage = $slugFile . '-' . $uuid;
            $pathImage = str_replace('https://www.vietmix.vn/', '', $song->image);
            $this->fileService->deleteImage($pathImage);
            $pathFile = $this->fileService->updateImage($file, "$fileImage.$extension");
            if ($pathFile != false) {
                $pathFileFull = 'https://www.vietmix.vn/'. $pathFile;
                $paramsUpdate['image'] = $pathFileFull;
            }
        }else{
            $paramsUpdate['image'] = $song->image;
        }
        $paramsUpdate['slug'] = $slugFile;
        $isSave = $this->songService->update($paramsUpdate, $id);
        if ($isSave) {
            return \redirect()->route('song.list');
        }
    }

    public function import()
    {
        return view('admin.imports.index');
    }

    public function importPost(Request $request)
    {
        if ($request->hasFile('song_file')) {
            $this->fileService->import($request->song_file);
        }
    }
}
