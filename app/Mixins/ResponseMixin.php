<?php

namespace App\Mixins;

class ResponseMixin
{
    public function successJson()
    {
        return function ($data = 'Data succesfully', $message = 'ok', $code = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $code);
        };
    }

    public function errorJson()
    {
        return function ($message = 'Error', $code = 400) {
            return response()->json([
                'success' => false,
                'message' => $message,
            ], $code);
        };
    }
}
