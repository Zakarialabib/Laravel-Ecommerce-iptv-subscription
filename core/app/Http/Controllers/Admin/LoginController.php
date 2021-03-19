<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Language;
use App\Setting;

class LoginController extends Controller
{
    public function __construct()
    {
        if (session()->has('lang')) {
            $currlang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currlang = Language::where('is_default', 1)->first();
        }
        $this->lang_id = $currlang->id;

    }

    public function login(){

        $commonsetting = Setting::where('id', 1)->first();
        return view('admin.login' , compact('commonsetting'));
    }

    public function authenticate(Request $request){


        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        //dd($request->all());

        if(Auth::guard('admin')->attempt(['username' => $request->username,'password' => $request->password])){

            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with('alert', 'Username and password not matched');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
      }

}
