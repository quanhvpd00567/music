<?php


namespace App\Services;


use App\Models\Image;
use App\Models\MasterCategory;
use App\Models\MasterSite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MasterService
{

    protected $_masterSiteModel;

    protected $_masterCategoryModel;

    protected $_imageModel;

    public function __construct(MasterSite $masterSite, MasterCategory $category, Image $image)
    {
        $this->_masterSiteModel = $masterSite;
        $this->_masterCategoryModel = $category;
        $this->_imageModel = $image;
    }

    public function getListMasterSite($params = [])
    {
        $sites = $this->_masterSiteModel
            ->with('masterCategories');
        if (isset($params['site_name'])) {
            $sites = $sites->where('name', 'like', '%'. $params['site_name'] .'%');
        }

        if (isset($params['status'])) {
            $sites = $sites->where('status', $params['status']);
        }

        if (isset($params['is_run_batch'])) {
            $sites = $sites->where('is_run_batch', $params['is_run_batch']);
        }
        return $sites->orderByDesc('id')->get();
    }

    public function getListMasterCategory($params = [])
    {
        $category = $this->_masterCategoryModel->with('masterSite')->with('category');
        if (isset($params['idSite'])) {
            $category = $category->where('master_site_id', $params['idSite']);
        }
        return $category->get();
    }

    public function updateSiteUseBatchClone($params)
    {
        try {
            DB::beginTransaction();
            $isBatch = $params['is_use_batch'] == 'true' ? MasterSite::$batch['run'] : MasterSite::$batch['not_run'];
            $this->_masterSiteModel->where('id', $params['id'])->update(['is_run_batch' => $isBatch]);
            DB::commit();
            return true;
        }catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function getAllImage($params = [])
    {
        $query = $this->_imageModel;

        if (isset($params['img_type'])){
            $query = $query->where('img_type', $params['img_type']);
        }

        $query = $query->orderBy('id', 'DESC');
        if (isset($params['isPage'])) {
            return $query->paginate(20);
        }
        return $query->get();
    }

    public function getDetailImageByParam($params = [])
    {
        $query = $this->_imageModel;
        if (isset($params['id'])) {
            $query = $query->where('id', $params['id']);
        }
        return $query->first();
    }

    public function createImage($params)
    {
        try {
             $this->_imageModel->create([
                'url' => $params['url'],
                'img_type' => $params['img_type'],
                'status' => 0,
            ]);
            return true;
        } catch (\Exception $exception){
            return false;
        }
    }

    public function updateImage($params)
    {
        try {
            $this->_imageModel->where('id', $params['id'])->update([
                'url' => $params['url'],
                'img_type' => $params['img_type'],
                'status' => 0,
            ]);
            return true;
        } catch (\Exception $exception){
            return false;
        }
    }
}
