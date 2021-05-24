<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(){
        if(is_null(Auth::user())){
            return redirect('/login');
        }else{
            $cart = Cart::with(['product'])->where('user_id', '=', Auth::user()->id)->where('status', '=', 'notyet')->get();
            return view('user.cart', ['cart'=>$cart]);
        }
    }

    public function store(Request $request){
        $cek = Cart::where('product_id', '=', $request->product_id)->where('user_id', '=', $request->user_id)->where('status','=','notyet')->first();
        
        if(is_null($cek)){
            $cart = new Cart;

            $cart->product_id = $request->product_id;
            $cart->user_id = $request->user_id;
            $cart->qty = 1;
            $cart->status = 'notyet';
            $cart->save();    
        }else{
            $cek->product_id = $request->product_id;
            $cek->user_id = $request->user_id;
            $cek->qty = $cek->qty + 1;
            $cek->status = 'notyet';
            $cek->save();
        }

        return redirect('/cart');
    }

    public function update(Request $request){
        $cart = Cart::find($request->id);

        if($request->qty == 0){
            $cart->status = 'cancelled';
            $cart->save();
            $carts = Cart::with(['product' => function($q){
                $q->with('product_image','discount');
            }])->where('user_id', '=', $request->user_id)->where('status', '=', 'notyet')->get();
            $hasil = view('user.recart',['carts' => $carts])->render();
            $jumlah = $carts->count();
            return response()->json(['success' => 'berhasil diganti', 'hasil' => $hasil, 'jumlah' => $jumlah]);
        }else{
            $cart->qty = $cart->qty+$request->qty;
            $cart->save();

            return response()->json(['success' => 'berhasil nambah']);
        }
    }
}
