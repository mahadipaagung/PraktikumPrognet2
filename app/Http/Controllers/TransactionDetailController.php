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
            return view('user.detailtransaksi');
        }
        
        $transaksi = Transaction::find($id);

        $review = Product_Review::where('user_id', '=', $transaksi->user_id)->get();

        if($transaksi->user_id != Auth::user()->id || is_null(Auth::user())){
            return redirect('/');
        }else{
            return view('user.detailtransaksi',['transaction' => $transaksi, 'reviews' => $review]);
        }
    }

    public function updatestatus(Request $request){

        $encryptid = Crypt::encrypt($request->id);

        $transaksi = Transaction::find($request->id);

        $user = User::find($transaksi->user_id);
        if($request->status == 1){
            $transaksi->status = 'canceled';
            $transaksi->save();
            return redirect('/transaksi/detail/'.$encryptid);
        }else if($request->status == 2){
            $transaksi->status = 'success';
            $transaksi->save();
            return redirect('/transaksi/detail/'.$encryptid);
        }
    }

    public function uploadProof(Request $request){
        $encryptid = Crypt::encrypt($request->id);
        $transaksi = Transaction::find($request->id);

        $path = 'proof_payment';

        $nama_img = $transaksi->proof_of_payment;
        
        if(!is_null($nama_img)){
            if(file_exists(public_path($path.'/'.$nama_img))){
                unlink(public_path($path.'/'.$nama_img));
            }else{
                dd('File does not exists.');
            }
        }

        $file = $request->file('file');
        $nama_awal = $file->getClientOriginalName();

        $nama_file = time()."_".$nama_awal;
        $file->move($path,$nama_file);

        $transaksi->proof_of_payment = $nama_file;
        $transaksi->save();

        return redirect('/transaksi/detail/'.$encryptid);
    }
}
