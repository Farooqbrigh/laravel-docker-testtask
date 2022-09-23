<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getData()
    {
        try {
            $user = User::select('id','name','email', 'counter')->get();
            if ($user) {
                return response()->json(['status' => 200, 'message' => 'Successfull', 'user' => $user]);
            } else {
                return response()->json(['status' => 404, 'message' => 'User Not Found']);
            }
        } catch (Exception $exception) {
            return response()->json(["message" => $exception->getMessage()]);
        }
    }
    public function postData(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return response()->json(['status' => 202, 'message' => $error]);
            }
            $check_email = User::where(['email' => $request->email])->first();
            if (!empty($check_email)) {
                return response()->json(['status' => 202, 'messgae' => 'email already exists']);
            }

            $user = [
                'name' => $request->name,
                'email' => $request->email
            ];

            $user = User::create($user);
            return response()->json(['status' => 200, 'message' => 'User Created Successfully', 'user' => $user]);

        } catch (Exception $exception) {
            return response()->json(["message" => $exception->getMessage()]);
        }
    }
}
