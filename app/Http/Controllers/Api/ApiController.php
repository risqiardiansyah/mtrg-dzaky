<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    public function sendResponse($code, $success, $status, $data = array())
    {
        return response()->json([
            'code' => $code,
            'success' => $success,
            'message' => $status,
            'data' => $this->normalizeResult($data)
        ], $code);
    }

    public function normalizeResult($result)
    {
        $result = json_decode(json_encode($result), true);

        array_walk_recursive($result, function (&$value) {
            $value = !is_null($value) ? $value : "";
        });

        return $result;
    }
}
