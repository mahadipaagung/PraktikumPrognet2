<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Product_Image;
use App\Product_Review;
use App\Response;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function diskon($discount,$harga){
        if($discount->count()){
            $dsk = $discount->sortByDesc('id');
            foreach($dsk as $d){
                $persen = $d;
                break;
            }

            if($persen->end >= date('Y-m-d')){
               return $harga = $harga-($harga * $persen->percentage/100);
            }else{
                return $harga = 0;
            }
        }else{
            return $harga = 0;
        }
    }
    public function tampildiskon($discount){
        if($discount->count()){
            $dsk = $discount->sortByDesc('id');
            foreach($dsk as $d){
                $persen = $d;
                break;
            }
            if($persen->end >= date('Y-m-d')){
                return $disc = $persen->percentage;
             }else{
                 return $disc = 0;
             }
        }else{
            return $disc = 0;
        }
    }
    
     public function review_product($id, Request $request)
    {
        $request->validate([
            'rate' => ['required'],
            'content' => ['required', 'max:100']
        ]);

        $user = Auth::user();
        $review = new Product_Review();
        $review->product_id = $id;
        $review->user_id = $user->id;
        $review->rate = $request->rate;
        $review->content = $request->content;
        if($review->save()){
            $product = Product::find($id);
            $avg_rate = DB::select('SELECT AVG(rate) as avg_rate FROM product_reviews WHERE product_id=?', [$id]);
            $avg_rate = json_decode(json_encode($avg_rate), true);
            $product->product_rate = (int)round($avg_rate[0]["avg_rate"]);
            $product->save();

            $admin = Admin::find(2);
            $details = [
                'order' => 'Review',
                'body' => 'User has review our Product!',
                'link' => url(route('product.edit',['id'=> $id])),
            ];

            return redirect()->back()->with("Success", "Successfully Comment");
        }
        return redirect()->back()->with("error", "Failed Comment");
    }
}
