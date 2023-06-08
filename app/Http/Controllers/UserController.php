<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class UserController extends Controller
{
    private function responseJson($status,$message,$data){
        return response()->json([$status,$message,$data]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'

        ]);
        if ($validator->fails()) {
                return $this->responseJson('failed',"Data Validation Error",$validator->errors());
        }
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if ($user) {
            return $this->responseJson('success',"User Created Successfully",$user);
        } else  return $this->responseJson('failed',"User Registration failed",[]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'

        ]);
        if ($validator->fails()) {
            return $this->responseJson('failed',"Data Validation Error",$validator->errors());
            
        }
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            return $this->responseJson('success',"Login Successfully",$token);
        } else {
            return $this->responseJson('failed',"Data Not matched",$validator->errors());
        }
    }

    public function user_details()
    {
        try{
            return response()->json([
                'status' => true,
                'message' => "User Fetched Successfully",
                'data' => User::all(),
                'errors' => null
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => null,
                'errors' => $e->getCode(),
            ]);
        }
    }
}