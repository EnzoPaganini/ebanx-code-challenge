<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse {

    public function successResponse($data, $message = 'success', $statusCode = Response::HTTP_OK) {
        return response()->json([
                        'success' => true,
                        'message' => $message,
                        'data' => $data
                    ], $statusCode);
    }

    public function errorResponse($errorMessage, $statusCode = Response::HTTP_BAD_REQUEST) {
        return response()->json([
                        'message'       => $errorMessage,
                        'success'       => false,
                        'error_code'    => $statusCode
                    ], $statusCode);
    }
}
