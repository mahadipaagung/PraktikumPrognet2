<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function show(){
        if(is_null(Auth::user())){
            return redirect('/login');
        }else{
            $carts = Cart::where('user_id', '=', Auth::user()->id)->where('status', '=' , 'notyet')->get();
            foreach($carts as $cart){
                $idcart = $cart->id;
                $product = $cart->product->id;
                $cekproduk = Product::find($product);

                $cart = Cart::find($idcart);

                if(!isset($cekproduk)){
                    $cart->status = 'producterror';
                    $cart->save();
                }else{
                    $stockprod = $cekproduk->stock;
                    if($stockprod < $cart->qty){
                        $cart->status = 'qtyerror';
                        $cart->save();
                    }
                }

                // if(!isset($cekproduk)){
                //     $cart->status = 'cancelled';
                //     $cart->save();
                // }else{
                //     $stockprod = $cekproduk->stock;
                //     if($stockprod < $cart->qty){
                //         $cart->qty = $stockprod;
                //         $cart->save();
                //     }else if($stockprod==0){
                //         $cart->status = 'cancelled';
                //         $cart->save();
                //     }
                // }
            }
            $carts = Cart::where('user_id', '=', Auth::user()->id)
            ->where(function($query){
                $query->where('status', '=', 'notyet')
                    ->orWhere('status', '=', 'producterror')
                    ->orWhere('status', '=', 'qtyerror');
            })->get();
            return view('user.cart', ['carts'=>$carts]);
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

        Alert::success('Item Added', 'Your item has been added to the cart!');
        return redirect('/cart');
    }

    public function update(Request $request){
        $cart = Cart::find($request->cart_id);

        if($request->action == 3){
            $cart->status = 'cancelled';
            $cart->save();

            $carts = Cart::where('user_id', '=', Auth::user()->id)
            ->where(function($query){
                $query->where('status', '=', 'notyet')
                      ->orWhere('status', '=', 'producterror')
                      ->orWhere('status', '=', 'qtyerror');
            })->get();

            $hasilr = view('user.filtercart',['carts' => $carts])->render();

            return response()->json(['hasil' => $hasilr]);

        }else if($request->action == 2){
            $cart->qty = $cart->qty - 1;
            $cart->status = 'notyet';
            $cart->save();

        }else if($request->action == 1){
            $cart->qty = $cart->qty + 1;
            $cart->status = 'notyet';
            $cart->save();
        }
        $carts = Cart::where('user_id', '=', Auth::user()->id)->where('status', '=' , 'notyet')->get();
        foreach($carts as $cart){
            $idcart = $cart->id;
            $product = $cart->product->id;
            $cekproduk = Product::find($product);

            $cart = Cart::find($idcart);

            if(!isset($cekproduk)){
                $cart->status = 'producterror';
                $cart->save();
            }else{
                $stockprod = $cekproduk->stock;
                if($stockprod < $cart->qty){
                    $cart->status = 'qtyerror';
                    $cart->save();
                }
            }
        }
        $carts = Cart::where('user_id', '=', Auth::user()->id)
        ->where(function($query){
            $query->where('status', '=', 'notyet')
                ->orWhere('status', '=', 'producterror')
                ->orWhere('status', '=', 'qtyerror');
        })->get();

        $hasilr = view('user.filtercart',['carts' => $carts])->render();

        return response()->json(['hasil' => $hasilr]);
    }
}
