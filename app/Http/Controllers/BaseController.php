<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function successResponse($code, $data, $message)
    {
        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
        return response()->json(
            $response,
            $code
        );
    }

    public function failResponse($code, $data, $message)
    {
        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
        return response()->json(
            $response,
            $code
        );
    }
}
