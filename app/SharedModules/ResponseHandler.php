<?php

namespace App\SharedModules;

class ResponseHandler
{
    public function __construct()
    {

    }

    public static function success($data, int $pageSize, int $pageNumber, bool $status = true){
        return response()->json([
            'status' => $status,
            'data' => $data,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
        ]);
    }

    public static function error(string $message, bool $status = false){
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }
}
