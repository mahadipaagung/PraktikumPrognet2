<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class HomeUnauthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('product')->get();

        $products = Product::with('product_image','product_category_detail','category','discount')->get();

        
        
        return view('home', ['product' => $products, 'category' => $categories]);
    }

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

    public function show($id){
        $product = Product::with('product_image','product_category_detail','category','discount')
        ->where('id','=',$id)->first();
        return view('user.product', ['products' => $product]);
    }

    public function show_kategori(Request $request){
        if($request->id == 0){
            $kategori = Product::with('product_image','discount')->get();
            $status = 0;
        }elseif($request->id == -1){
            $kategori = Product::with('product_image','discount')->where('product_name','like','%'.$request->cari.'%')->get();
            $status = 0;
        }else{
            $kategori = Category::with(['product' => function($q){
                $q->with('discount', 'product_image');
            }])->where('id','=',$request->id)->first();
            $status = 1;
        }
        $hasil = view('user.filter', ['kategori' => $kategori, 'status' => $status])->render();
        return response()->json(['success' => 'Produk berhasil dimasukkan dalam cart', 'hasil' => $hasil]);
    }
}
