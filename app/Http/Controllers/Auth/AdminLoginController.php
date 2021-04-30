<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin', ['except'=>['logout']]);
    }

    public function showLoginform(){
        return view('admin-login');
    }

    public function login(Request $request){
        //validasi data di form
        $data = $this->validate($request,
            [
                'username'=>'required|string',
                'password'=>'required|string|min:8',
            ]
        );
        // dd($data);
        //percobaan login
        if(Auth::guard('admin')->attempt(['username'=> $request->username, 'password'=> $request->password],$request->remember)){
            //redirect if successful login
            // Jika Berhasil
            return redirect()->intended(route('admin.dashboard'));
        }else {
             //redirect if unsuccessful login
            return redirect()->back()->withInput($request->only('username','remember'));
        }
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect('/');
    }    
    
}
