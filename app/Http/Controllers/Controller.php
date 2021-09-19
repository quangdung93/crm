<?php

namespace App\Http\Controllers;

use App\Traits\UploadImage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use UploadImage;

    protected function responseJson($status = true, $message, $data = null){
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response);
    } 
}
