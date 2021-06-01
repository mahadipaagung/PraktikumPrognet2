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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web']);
    }

    public function inbeli(Request $request)
    {
        $provinsi = Province::where('province_id','=',$request->province)->first();
        $kota = City::where('city_id','=',$request->regency)->first();
        
        $transaksi = new Transaction;

        date_default_timezone_set("Asia/Makassar");
        $waktuhabis = Carbon::now()->addDay();
        $transaksi->timeout = $waktuhabis;

        $transaksi->address = $request->inaddress;
        $transaksi->regency = $kota->title;
        $transaksi->province = $provinsi->title;

        $transaksi->total = $request->total;
        $transaksi->shipping_cost = $request->delivery;
        $transaksi->courier_id = $request->courier;
        $transaksi->status = 'unverified';

        $transaksi->sub_total = $request->subtotal;
        $transaksi->user_id = $request->user_id;
        $transaksi->telp = $request->phonenumber;

        $transaksi->save();
        
        if($request->jumlah == 1){
            $detail_transaksi = new Transaction_Detail;

            $detail_transaksi->transaction_id = $transaksi->id;
            $detail_transaksi->product_id = $request->product_id;
            $detail_transaksi->qty = $request->qty;

            $produk = Product::where('id','=',$request->product_id)->first();

            if(!is_null($produk->discount)){
                foreach($produk->discount as $diskon){
                    if($diskon->end > date('Y-m-d')){
                        $detail_transaksi->discount = $diskon->percentage;
                    }else{
                        $detail_transaksi->discount = 0;
                    }
                }
            }else{
                $detail_transaksi->discount = 0;
            }
            $detail_transaksi->selling_price = $produk->price;
            $detail_transaksi->save();
        }else{
            $cart = Cart::where('user_id', '=', $request->user_id)->where('status', '=', 'notyet')->get();
    
            foreach($cart as $item){
                $detail_transaksi = new Transaction_Detail;

                $detail_transaksi->transaction_id = $transaksi->id;
                $detail_transaksi->product_id = $item->product->id;
                $detail_transaksi->qty = $item->qty;

                if(!is_null($item->product->discount)){
                    foreach($item->product->discount as $diskon){
                        if($diskon->end > date('Y-m-d')){
                            $detail_transaksi->discount = $diskon->percentage;
                        }else{
                            $detail_transaksi->discount = 0;
                        }
                    }
                }else{
                    $detail_transaksi->discount = 0;
                }
                $detail_transaksi->selling_price = $item->product->price;
                $detail_transaksi->save();
    
                $item->status = 'checkedout';
                $item->save();
            }
        }

        $encryptid = Crypt::encrypt($request->user_id);

        $admin= Admin::find(1);
        $data= [
            'nama'=> Auth::user()->name,
            'pesan'=> 'melakukan transaksi'
        ];
        $endcode = json_encode($data);
        $admin->createnotifyadmin($endcode); 

        return redirect('/transaksi/'.$encryptid);
    }

    public function index($param){

        try {
            $id = Crypt::decrypt($param);
        } catch (DecryptException $exception) {
            Alert::error('Transaction Not Found', 'You enter the wrong transaction information! Redirecting back to Home.');
            return redirect('/');
        }

        if(is_null(Auth::user())){
            return redirect('/login');
        }else if(Auth::user()->id != $id){
            return redirect('/');
        }else{
            $transaksi = Transaction::where('user_id','=',$id)->orderBy('id', 'DESC')->simplePaginate(6);

            foreach($transaksi as $item){
                if(!is_null($item->proof_of_payment) & $item->status == 'unverified'){
                    $item->status = 'waiting approval';
                    $item->save();
                }
                if($item->timeout < date('Y-m-d H:i:s') & $item->status == 'unverified'){
                    $item->status = 'expired';
                    $item->save();
                }
            }
            return view('user.transaksi', ['transactions' => $transaksi]);
        }
    }

    public function adminIndex(){
        $transaksi = Transaction::all();
        return view('admin.transaksi', ['transaksi' => $transaksi]);
    }
}
