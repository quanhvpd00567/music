<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterCategoryRequest;
use App\Models\Image;
use App\Models\MasterCategory;
use App\Services\CategoryService;
use App\Services\MasterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class MasterController extends Controller
{
    protected $masterService;
    protected $categoryService;

    public function __construct(MasterService $masterService, CategoryService $categoryService)
    {
        $this->masterService = $masterService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $sites = $this->masterService->getListMasterSite($request);
        $data = [
            'sites' => $sites
        ];
        return view('admin.master.index', $data);
    }

    public function category($idWebsite, Request $request)
    {
        $params = [
            'idSite' => $idWebsite
        ];
        $categories = $this->masterService->getListMasterCategory($params);
        $data = [
            'categories' => $categories,
            'idWebsite' => $idWebsite
        ];
        return view('admin.master.categories.category', $data);
    }

    public function createMasterCategory($idWebsite)
    {
        $data = [
            'listCategories' => $this->categoryService->getList(),
            'idWebsite' => $idWebsite,
            'category' => new MasterCategory()
        ];
        return view('admin.master.categories.create', $data);
    }

    public function postMasterCategory($idWebsite, MasterCategoryRequest $request)
    {
        $params = $request->only([
            'category_clone',
            'category_id',
            'is_run_batch'
        ]);

        $params['is_run_batch'] = isset($params['is_run_batch']) ? 0 : 1;
        $params['master_site_id'] = $idWebsite;
        $params['slug'] = $params['category_clone'];

        $isSave = $this->masterService->createMasterCategory($params);
        if ($isSave) {
            return redirect()
                ->route('admin.master.category_list', ['id' => $idWebsite])
                ->with('create_success', 'Create new a category clone successfully!');;
        }
        return redirect()
            ->route('admin.master.category_list',  ['id' => $idWebsite])
            ->with('create_failed', 'Create new a category clone failed!');
    }

    public function editMasterCategory($idSite, $idCategory)
    {
        $data = [
            'listCategories' => $this->categoryService->getList(),
            'idWebsite' => $idSite,
            'category' => $this->masterService->getMasterCategoryDetail($idCategory)
        ];
        return view('admin.master.categories.edit', $data);
    }

    public function updateMasterCategory($idWebsite, $idCategory, MasterCategoryRequest $request)
    {
        $params = $request->only([
            'category_clone',
            'category_id',
            'is_run_batch'
        ]);

        $params['is_run_batch'] = isset($params['is_run_batch']) ? 0 : 1;
        $params['master_site_id'] = $idWebsite;
        $params['slug'] = $params['category_clone'];

        $isSave = $this->masterService->updateMasterCategory($params, $idCategory);
        if ($isSave) {
            return redirect()
                ->route('admin.master.category_list', ['id' => $idWebsite])
                ->with('create_success', 'Update category clone successfully!');;
        }
        return redirect()
            ->route('admin.master.category_list',  ['id' => $idWebsite])
            ->with('create_failed', 'Update category clone failed!');
    }


    public function changeBatch(Request $request)
    {
        try {
            $params = $request->only([
                'id', 'is_use_batch'
            ]);
            $isUpdate = $this->masterService->updateSiteUseBatchClone($params);
            if ($isUpdate) {
                return Response::json(['message' => 'Update successfully','status' => true], 200);
            }
            return Response::json(['message' => 'Update failed','status' => false], 400);
        } catch (\Exception $exception) {
            return Response::json(['message' => 'Update failed','status' => false], 400);
        }
    }

    public function images()
    {
        $images = $this->masterService->getAllImage(['isPage' => true]);
        return view('admin.master.images', compact('images'));
    }

    public function createImages()
    {
        $listImageType = Image::$listImageType;
        return view('admin.master.form_image', compact('listImageType'));
    }

    public function postImages(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'url' => 'required|max:255',
            'img_type' => 'required',
        ]);
        if ($validatedData->fails()) {
            return redirect()->route('admin.master.images.get')
                ->withErrors($validatedData)
                ->withInput();
        }

        $isSave = $this->masterService->createImage($request);
        if ($isSave) {
            return redirect()->route('admin.master.images.list')->with('create_success', 'Create new a image successfully!');
        }
        return redirect()->route('admin.master.images.list')->with('create_failed', 'Create new a image failed!');
    }

    public function editImages($id)
    {
        $listImageType = Image::$listImageType;

        $image = $this->masterService->getDetailImageByParam(['id' => $id]);
        return view('admin.master.form_image', compact('listImageType', 'image'));
    }

    public function updateImages($id, Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'url' => 'required|max:255',
            'img_type' => 'required',
        ]);
        if ($validatedData->fails()) {
            return redirect()->route('admin.master.images.edit', ['id' => $id])
                ->withErrors($validatedData)
                ->withInput();
        }
        $paramsUpdate = [
            'id' => $id,
            'url' => $request->url,
            'img_type' => $request->img_type,
        ];

        $isSave = $this->masterService->updateImage($paramsUpdate);
        if ($isSave) {
            return redirect()->route('admin.master.images.list')->with('create_success', 'Update new a image successfully!');
        }
        return redirect()->route('admin.master.images.list')->with('create_failed', 'Update new a image failed!');
    }
}
