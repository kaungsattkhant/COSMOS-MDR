<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;



if (! function_exists('ResponseMessage')) {
    function ResponseMessage(string $message, int $status = 200, $data = null): JsonResponse
    {
        return response()->json([
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }
}

