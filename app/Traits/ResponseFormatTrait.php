<?php

namespace App\Traits;

trait ResponseFormatTrait
{
    private $responseData = array(
        'error' => 1,
        'message' => 'Chưa thiết lập response.',
        'data' => array()
    );

    protected function responseJson($error, $data = null, $message = null, $subMessage = "", $errorCode = null)
    {
        $this->responseData = [];

        $this->responseData['error'] = $error;

        if($data){
            $this->responseData['data'] = $data;
        }

        $this->responseData['message'] = [
            'title' => $message ?: 'Xử lý thành công.',
            'sub_message' => $subMessage,
            'error_code' => $errorCode
        ];

        return response()->json($this->responseData);
    }
}