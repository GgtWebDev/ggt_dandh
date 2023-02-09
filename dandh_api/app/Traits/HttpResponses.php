<?php

namespace App\Traits;

trait HttpResponses
{
    protected function success($data = null, $message = '', $code = 200)
    {
        if ($data) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => $message,
                    'data' => $data
                ],
                $code
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => $message,
            ],
            $code
        );
    }

    protected function error($data = null, $message = '', $code)
    {
        if ($data) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $message,
                    'data' => $data
                ],
                $code
            );
        }

        return response()->json(
            [
                'status' => 'error',
                'message' => $message,
            ],
            $code
        );
    }
}
