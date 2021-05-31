<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use App\Response;
use App\Product_Review;
use App\User;
use Illuminate\Support\Facades\Auth;

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
       
        return view('admin.detail_transaksi',['transaksi' => $transaksi, 'review' => $review, 'response' => $response]);
     
    }

    public function membatalkanPesanan(Request $request){
        $transaksi = Transaction::find($request->id);
        $user = User::find($transaksi->user_id);
        if($request->status == 1){
            $transaksi->status = 'canceled';
            $transaksi->save();

            $admin= User::find(1);
            $data= [
                'nama'=> 'admin',
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
                'nama'=> 'admin',
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
                'nama'=> 'admin',
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
                'nama'=> 'admin',
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
                'nama'=> 'admin',
                'pesan'=> 'Transaksi Terkirim'
            ];
            $endcode = json_encode($data);
            $admin->createnotifyuser($endcode);

            return redirect('admin/transaksi/detail/'.$request->id);
        }
    }

}
