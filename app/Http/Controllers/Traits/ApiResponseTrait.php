<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{

    /**
     * Api success response
     *
     * @param mixed $data
     * @param integer $code
     * @return void
     * @return JsonResponse
     */
    protected function successResponse(mixed $data, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], $code);
    }

    /**
     * Api error response
     *
     * @param string $message
     * @param integer $code
     * @return JsonResponse
     */
    protected function errorResponse(string $message, $code): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}