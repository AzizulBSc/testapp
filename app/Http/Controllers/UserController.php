<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
<<<<<<< HEAD
use App\Traits\ResponseTrait;
use Carbon\Carbon;
=======
>>>>>>> 61b70c744a64c4f71d5f8eaffb4a02c9ca993b1b
use Exception;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseTrait;
class UserController extends Controller
{
    use ResponseTrait;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'

        ]);
        if ($validator->fails()) {
                return $this->responseError($validator->errors(),"Data Validation Error");
        }
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if ($user) {
            return $this->responseSuccess($user,'User Created Successfully ');
        } else  return $this->responseError('failed',"User Registration failed");
    }


    public function login(Request $request)
    {
<<<<<<< HEAD
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
=======
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'

        ]);
        if ($validator->fails()) {
            return $this->responseError($validator->errors(),"Data Validation Error");
            
        }
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('authToken');
            $data = [
                'user'=>$user,
                'access_token'=>$token->accessToken,
                'token_type'=>"Bearer",
            ];
            return $this->responseSuccess($data,'Login Successfully');
        } else {
            return $this->responseError("Data Not Found","Data Not matched");
>>>>>>> 61b70c744a64c4f71d5f8eaffb4a02c9ca993b1b
        }
    }

    public function user_details()
<<<<<<< HEAD
    {   //finally it is well
        return $this->responseSuccess(User::all(), "Users Data Fetch Successfully");
=======
    { 
        //update
        try{
            return $this->responseSuccess(User::all(),"User Fetched Successfully");
        }
        catch(Exception $e){
            return $this->responseError([],$e->getMessage());
        }
>>>>>>> 61b70c744a64c4f71d5f8eaffb4a02c9ca993b1b
    }
}
