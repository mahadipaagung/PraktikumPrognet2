<?php

namespace App\Http\Controllers;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\AdminNotification;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function registerAdmin()
    {
        return view('admin.admin-register');
    }


    public function manageAdmin(){
    
        $listAdmin = Admin::all();
        return view('admin.manage_admin', ['listAdmin' => $listAdmin]);
    }

    public function destroyAdmin($id){
        $adminnya = Admin::find($id);
        $adminnya->delete();
        return redirect("admin.manage_admin")->with('delete','Data berhasil dihapus');
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
            
            return redirect('/admin/manage-admin');
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->only('name','username'));
        }
    }
}
