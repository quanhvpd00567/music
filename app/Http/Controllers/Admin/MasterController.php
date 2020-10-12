<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Services\MasterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class MasterController extends Controller
{
    protected $masterService;

    public function __construct(MasterService $masterService)
    {
        $this->masterService = $masterService;
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
            'categories' => $categories
        ];
        return view('admin.master.category', $data);
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
