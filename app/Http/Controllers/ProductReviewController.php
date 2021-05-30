<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_Review;
use App\Product;
use App\Admin;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function store(Request $request){

        $cekreview = Product_Review::where('product_id', '=', $request->product_id)
        ->where('user_id', '=', $request->user_id)->where('transaction_id', '=', $request->trans_id)->first();
        $cekproduk = Product::find($request->product_id);

        if(is_null($cekreview)){
            $review = new Product_Review;
            $review->product_id = $request->product_id;
            $review->user_id = $request->user_id;
            $review->transaction_id = $request->trans_id;
            $review->rate = $request->rate;
            $review->content = $request->content;
    
            $review->save();
    
            $reviews = Product_Review::where('product_id', '=', $request->product_id)->get();
            $meanRate = 0;
            $count = $reviews->count();
    
            foreach($reviews as $item){
                $meanRate = $meanRate+$item->rate;
            }
    
            $meanRate = $meanRate / $count;
    
            $produk = Product::find($request->product_id);
            $produk->product_rate = $meanRate;
            $produk->save();

            Alert::success('Review Added', 'Your review is added to the product!');

            return redirect('/product/'.$cekproduk->slug);
        }else{
            $review = Product_Review::find($cekreview->id);

            $review->product_id = $request->product_id;
            $review->user_id = $request->user_id;
            $review->rate = $request->rate;
            $review->content = $request->content;
    
            $review->save();
    
            $reviews = Product_Review::where('product_id', '=', $request->product_id)->get();
            $meanRate = 0;
            $count = $reviews->count();
    
            foreach($reviews as $item){
                $meanRate = $meanRate+$item->rate;
            }
    
            $meanRate = $meanRate / $count;
    
            $produk = Product::find($request->product_id);
            $produk->product_rate = $meanRate;
            $produk->save();

            Alert::success('Review Updated', 'Your review is updated to the product!');
            return redirect('/product/'.$cekproduk->slug);
        }

        


        // $admin = Admin::find(1);
        // $notif = "<a class='dropdown-item' href='/admin/products/".$produk->id."'>".
        //         "<div class='item-content flex-grow'>".
        //           "<h6 class='ellipsis font-weight-normal'></h6>".
        //           "<p class='font-weight-light small-text text-muted mb-0'>Produk diberikan Review!".
        //           "</p>".
        //         "</div>".
        //       "</a>";
        // $admin->notify(new AdminNotification($notif));
    }

    // public function update(Request $request){
    //     $review = Product_Review::find($request->review_id);
    //     $review->rate = $request->rate;
    //     $review->content = $request->content;
    //     $review->save();

    //     $reviews = Product_Review::where('product_id', '=', $review->product_id)->get();
    //     $meanRate = 0;
    //     $count = $reviews->count();

    //     foreach($reviews as $item){
    //         $meanRate = $meanRate+$item->rate;
    //     }

    //     $meanRate = $meanRate / $count;

    //     $produk = Product::find($review->product_id);
    //     $produk->product_rate = $meanRate;
    //     $produk->save();

    //     return redirect('/product/'.$review->product_id);
    // }
}
