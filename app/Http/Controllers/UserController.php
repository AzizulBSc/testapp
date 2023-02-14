<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class UserController extends Controller
{
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'fails', 'validation_error' => $validator->errors()]);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            return response()->json(['status' => 'success', 'login' => true, 'token' => $token, 'data' => $user]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Login failed Data Not Valid ', 'login' => false,]);
        }
    }
    public function user_details()
    {
        $user = Auth::user();
        if ($user) {
            return response()->json(['status' => 'success', 'user' => $user]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'User Not Found']);
        }
    }
}