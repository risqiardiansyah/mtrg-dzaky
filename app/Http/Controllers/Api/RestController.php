<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RestController extends ApiController
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

    public function test()
    {
        return $this->sendResponse(200, true, "Data Found", []);
    }

    public function validateThis($request, $rules)
    {
        return Validator::make($request->all(), $rules);
    }

    public function login(Request $request)
    {
        $rules = [
            'kode_mahasiswa' => 'required',
            'password' => 'required'
        ];

        $validator = $this->validateThis($request, $rules);
        if ($validator->fails()) {
            return $this->sendResponse(401, false, "Params Not complete", validationMessage($validator->errors()));
        }

        $credentials = [
            'kode_mahasiswa' => $request->kode_mahasiswa,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            return $this->sendResponse(401, false, "Worng Credentials", (object)[]);
        }

        $success = Auth::user();
        $success['token'] = Auth::user()->createToken(Auth::guard()->user()->email)->accessToken;
        $success['kode_mahasiswa'] = Auth::guard()->user()->kode_mahasiswa;

        return $this->sendResponse(200, true, 'Login Success', $success);
    }
}
