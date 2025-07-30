<?php

namespace App\Helper;

class ApiResponse
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Function: success
     * @param mixed $status
     * @param mixed $message
     * @param mixed $data
     * @param mixed $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($status = 'success', $message = null, $data = [], $statusCode = 200)
    {
        return response()->json(
            [
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ],
            $statusCode
        );
    }

    /**
     * Function: success
     * @param mixed $status
     * @param mixed $message
     * @param mixed $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($status = 'success', $message = null, $statusCode = 500)
    {
        return response()->json(
            [
                'status' => $status,
                'message' => $message,
            ],
            $statusCode
        );
    }


}
