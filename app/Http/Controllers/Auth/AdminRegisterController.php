<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class AdminRegisterController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin');
    }

    public function showRegistrationForm()
    {
        return view('admin-register');
    }

    public function register(Request $request ){
        $this->validate($request,
            [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:admins'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        
        );

        try {
            $admin = Admin::create([
                'username' => $request->username,
                'name' => $request->name,
                'profile_image'=> $request->profile_image,
                'phone' =>$request->phone,
                'password' => Hash::make($request->password),
            ]);
            Auth::guard('admin')->loginUsingId($admin->id);
            return redirect()->route('admin.dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->only('name','username'));
        }
    }
}
