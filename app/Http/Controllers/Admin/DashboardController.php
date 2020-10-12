<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MasterService;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        return view('admin.dashboard.index', $data);
    }
}
