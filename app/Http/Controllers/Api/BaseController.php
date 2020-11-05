<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function success($data = [], $status = 200, $header = [])
    {

        return response(['data' => $data, 'message' => null, 'code' => null], $status, $header);
    }
    public function error($message = '', $code = '', $status = 500, $header = [])
    {
        return response(['data' => [], 'message' => $message, 'code' => $code], $status, $header);
    }
}
