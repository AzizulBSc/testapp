<?php

namespace App\Traits\ResponseTrait;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ResponseTrait
{
    /**
     * Success response.
     *
     * @param array|object $data
     * @param string $message
     *
     * @return JsonResponse
     */
    public function responseSuccess($data, $message = "Successful")
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'errors' => null
        ]);
    }

    /**
     * Error response.
     *
     * @param array|object $errors
     * @param string $message
     * @param int $responseCode
     *
     * @return JsonResponse
     */
    public function responseError($errors, $message = "Something went wrong.")
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => null,
            'errors' => $errors
        ]);
    }
}