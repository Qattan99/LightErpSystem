<?php

namespace App\SharedModules;

class ResponseHandler
{
    public function __construct()
    {

    }

    public static function success($data, int $totalCount = 0, int $pageNumber = 1, bool $status = true){
        return response()->json([
            'status' => $status,
            'message' => "Success",
            'data' => $data,
            'pageNumber' => $pageNumber,
            'totalCount' => $totalCount,
        ]);
    }

    public static function error(string $message, bool $status = false){
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => null,
            'pageNumber' => 1,
            'pageSize' => 0,
        ]);
    }

}
