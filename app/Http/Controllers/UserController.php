<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class UserController extends Controller
{
    use ResponseTrait;
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'fails', 'validation_error' => $validator->errors()]);
        }
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if ($user) {
            return response()->json(['status' => 'success', 'message' => "User Registration Successfully Completed", 'data' => $user]);
        } else return response()->json(['status' => 'failed', 'message' => "User Registration failed"]);
    }


    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->responseError([], 'No user Found');
        }
        if (Hash::check($request->password, $user->password)) {
            $createdToken = $user->createToken('authToken')->accessToken;
            $data = [
                'user' => $user,
                'access_token' => $createdToken,
                'token_type' => 'Bearer',
            ];
            return $this->responseSuccess($data, "logged In successfully");
        }
    }
    public function user_details()
    {
        return $this->responseSuccess(User::all(), "Users Data Fetch Successfully");
    }
}
