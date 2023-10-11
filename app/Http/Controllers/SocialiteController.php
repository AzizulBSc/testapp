<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $exist_user = User::where('google_id', $user->id)->first();
            if ($exist_user) {
                Auth::login($exist_user);
                // dd('login');
                return redirect('/home');
            } else {
                $new_user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('1234dummy')
                ]);
                Auth::login($new_user);
                // dd('test');
                return redirect('/home');
            }
        } catch (Exception $e) {
            echo ($e->getMessage());
        }
    }
    public function home()
    {
        return redirect()->url('/admin');
        return view('home');
    }
    public function token(){

    }
}
