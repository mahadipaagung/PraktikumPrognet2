<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Transaction_Detail;
use App\Province;
use App\City;
use App\Cart;
use App\Product;
use App\Admin;
use Illuminate\Support\Facades\Auth;


class AdminTransaksiController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index(){
        $transaksi = Transaction::all();
        return view('admin.transaksi', ['transaksi' => $transaksi]);
    }
}
