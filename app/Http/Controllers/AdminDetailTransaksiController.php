<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use App\Response;
use App\Product_Review;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminDetailTransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    
    public function index($id){
        $transaksi = Transaction::find($id);
        $response = Response::all();

        $review = Product_Review::where('user_id', '=', $transaksi->user_id)->get();
       
        return view('admin.detail_transaksi',['transaksi' => $transaksi, 'review' => $review, 'response' => $response, 'id'=>$id]);
     
    }

    public function membatalkanPesanan(Request $request){
        $transaksi = Transaction::find($request->id);
        $user = User::find($transaksi->user_id);
        if($request->status == 1){
            $transaksi->status = 'canceled';
            $transaksi->save();

            $admin= User::find(1);
            $data= [
                'nama'=> Auth::user('admin')->name,
                'pesan'=> 'Transaksi Batal'
            ];
            $endcode = json_encode($data);
            $admin->createnotifyuser($endcode); 

            return redirect('/transaksi/detail/'.$request->id);
        }elseif($request->status == 3){
            $transaksi->status = 'verified';
            $transaksi->save();
            foreach($transaksi->transaction_detail as $item){
                $produk = Product::find($item->product_id);
                $produk->stock = $produk->stock - $item->qty;
                $produk->save();
            }

            $admin= User::find(1);
            $data= [
                'nama'=> Auth::user('admin')->name,
                'pesan'=> 'Transaksi Diterima'
            ];
            $endcode = json_encode($data);
            $admin->createnotifyuser($endcode); 

            return redirect('admin/transaksi/detail/'.$request->id);
        }elseif($request->status == 2){
            $transaksi->status = 'success';
            $transaksi->save();

            $admin= User::find(1);
            $data= [
                'nama'=> Auth::user('admin')->name,
                'pesan'=> 'Transaksi Berhasil'
            ];
            $endcode = json_encode($data);
            $admin->createnotifyuser($endcode);

            return redirect('/transaksi/detail/'.$request->id);
        }elseif($request->status == 4){
            $transaksi->status = 'indelivery';
            $transaksi->save();

            $admin= User::find(1);
            $data= [
                'nama'=> Auth::user('admin')->name,
                'pesan'=> 'Transaksi Belum Terkirim'
            ];
            $endcode = json_encode($data);
            $admin->createnotifyuser($endcode); 

            return redirect('admin/transaksi/detail/'.$request->id);
        }else{
            $transaksi->status = 'delivered';
            $transaksi->save();

            $admin= User::find(1);
            $data= [
                'nama'=> Auth::user('admin')->name,
                'pesan'=> 'Transaksi Terkirim'
            ];
            $endcode = json_encode($data);
            $admin->createnotifyuser($endcode);

            return redirect('admin/transaksi/detail/'.$request->id);
        }
    }

    public function rejectproof(Request $request){
        $id=$request->id;
        $id_detail=$request->id_detail;
        $transaksi = Transaction::find($id);
        
        date_default_timezone_set("Asia/Makassar");
        $waktuhabis = Carbon::now()->addDay();
        $transaksi->timeout = $waktuhabis;
        $transaksi->proof_of_payment=NULL;
        $transaksi->status= 'unverified';
        

        $transaksi->save();

        return redirect('admin/transaksi/detail/'.$request->id_detail);
    }
}
