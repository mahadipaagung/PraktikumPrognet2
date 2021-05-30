<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use App\Product_Review;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web']);
    }

    public function index($param){
        try {
            $id = Crypt::decrypt($param);
        } catch (DecryptException $exception) {
            Alert::error('Transaction Detail Not Found', 'You enter the wrong transaction detail information! Redirecting back to Home.');
            return redirect('/');
        }
        
        $transaksi = Transaction::find($id);

        $review = Product_Review::where('user_id', '=', $transaksi->user_id)->get();

        if($transaksi->user_id != Auth::user()->id || is_null(Auth::user())){
            return redirect('/');
        }else{
            $transaksis = Transaction::where('user_id','=',$transaksi->user_id)->get();

            foreach($transaksis as $item){
                if(!is_null($item->proof_of_payment) & $item->status == 'unverified'){
                    $item->status = 'waiting approval';
                    $item->save();
                }
                if($item->timeout < date('Y-m-d H:i:s') & $item->status == 'unverified'){
                    $item->status = 'expired';
                    $item->save();
                }
            }
            return view('user.detailtransaksi',['transaction' => $transaksi, 'reviews' => $review]);
        }
    }

    public function updatestatus(Request $request){

        $encryptid = Crypt::encrypt($request->id);

        $transaksi = Transaction::find($request->id);

        if($request->status == 1){
            $transaksi->status = 'canceled';
            $transaksi->save();
            Alert::success('Order Canceled', 'You successfully cancelled your order.');
            return redirect('/transaksi/detail/'.$encryptid);

        }else if($request->status == 2){
            $transaksi->status = 'success';
            $transaksi->save();
            Alert::success('Order Finisihed', 'Thank you for your purchase.');
            return redirect('/transaksi/detail/'.$encryptid);
        }
    }

    public function uploadProof(Request $request){
        $pathhome = base_path();

        $encryptid = Crypt::encrypt($request->id);
        $transaksi = Transaction::find($request->id);

        $path = $pathhome.'/public/proof_payment/';

        $nama_img = $transaksi->proof_of_payment;
        
        $status = 1;

        if(!is_null($nama_img)){
            if(file_exists($path.$nama_img)){
                unlink($path.$nama_img);
                $status = 2;
            }
        }else{
            $status = 1;
        }

        $file = $request->file('file');
        $nama_awal = $file->getClientOriginalName();

        $nama_file = time()."_".$nama_awal;
        $file->move($path,$nama_file);

        $transaksi->status = 'waiting approval';
        $transaksi->proof_of_payment = $nama_file;
        $transaksi->save();

        if($status==2){
            Alert::success('Proof Updated', 'Thank you for payment.');
        }else if($status==1){
            Alert::success('Proof Uploaded', 'Thank you for payment.');
        }

        return redirect('/transaksi/detail/'.$encryptid);
    }
}
