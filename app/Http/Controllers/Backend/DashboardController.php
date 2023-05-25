<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class DashboardController extends Controller
{
    public function index(){
        // dd(Auth::guard('admin')->user());
        if(!Auth::guard('admin')->user()){
            session()->flash('error', 'You Are not Login Please login');
            return redirect()->route('admin.login');
        }
        return view('backend.layouts.master');
    }
}
