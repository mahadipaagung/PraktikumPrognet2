<?php

namespace App\Http\Controllers;
use App\Admin;
use Illuminate\Http\Request;
use App\AdminNotification;

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

    public function manageAdmin(){
    
        $listAdmin = Admin::all();
        return view('admin.manage_admin', ['listAdmin' => $listAdmin]);
    }
}
