<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Cart;
use App\Province as Provinsi;
use App\City;
use App\Courier as kurir;
use App\Product;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    public function index(Request $request){
        if(!is_null($request->product_id)){
            $cart = Product::where('id', '=', $request->product_id)->get();
            $weight = $request->weight;
            $qty = $request->qty;
            $product_id = $request->product_id;
        }else{
            $cart = Cart::where('user_id', '=', $request->user_id)->where('status', '=', 'notyet')->get();
            $qty = 0;
            $product_id = 0;
            $weight = 0;
        }
        $provinsi = Provinsi::all();
        $kurir = kurir::all();

        return view('user.checkout',[
            'cart'=>$cart,
            'provinsi' => $provinsi,
            'kurir' => $kurir,
            'weight'=>$weight,
            'qty'=>$qty,
            'product_id'=>$product_id]);
    }

    public function cekkota($id){
        $city = City::where('province_id','=',$id)->pluck('title','city_id');
        return json_encode($city);
    }

    public function cekongkir(Request $request){
        $kurir = kurir::where('id','=',$request->courier)->first();
        $cost = RajaOngkir::ongkosKirim([
            'origin' => 114,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $kurir->code,
        ])->get();

        $hasil = $cost[0]['costs'][0]['cost'][0];
        return response()->json(['success' => 'terkirim', 'hasil' => $hasil]);
    }
}
