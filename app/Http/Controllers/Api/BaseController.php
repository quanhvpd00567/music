<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function success($data = [], $status = 200, $header = [])
    {
        return response($data, $status, $header);
    }
}
