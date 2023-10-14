<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ResponseTrait;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Data Validation Error');
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        if ($user) {
            return $this->responseSuccess($user, 'User Created Successfully');
        } else {
            return $this->responseError('Failed', 'User Registration failed');
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return $this->responseError($validator->errors(), 'Data Validation Error');
        }

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return $this->responseError([], 'No user Found');
        }

        if (Hash::check($request->password, $user->password)) {
            $createdToken = $user->createToken('authToken')->accessToken;
            $data = [
                'user' => $user,
                'access_token' => $createdToken,
                'token_type' => 'Bearer',
            ];

            return $this->responseSuccess($data, 'Logged In successfully');
        } else {
            return $this->responseError([], 'Password does not match');
        }
    }

    public function user_details()
    {
        // Update - you may want to apply pagination for large datasets
        try {
            return $this->responseSuccess(User::all(), 'Users Fetched Successfully');
        } catch (Exception $e) {
            return $this->responseError([], $e->getMessage());
        }
    }
}
