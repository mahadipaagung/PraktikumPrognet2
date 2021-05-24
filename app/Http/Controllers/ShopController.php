<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function show()
    {
        $categories = Category::all();
        $products = Product::simplePaginate(6);
        return view('user.shop', ['product' => $products, 'category' => $categories]);
    }
    public function search(Request $request)
	{
		$cari = $request->product_name;
        $categories = Category::all();
		$products = Product::where('product_name','like',"%".$cari."%")->simplePaginate(6);
		return view('user.shop', ['product' => $products, 'category' => $categories]);
	}
    public function filter(Request $request){
        $value = $request->category_id;
        if($value=="all_categories"){
            $categories = Category::all();
            $products = Product::simplePaginate(6);
        }else{
            $categories = Category::all();
            $products = Product::whereHas('category', function ($query) use ($value) {
                return $query->where('category_id', '=',  $value);
            })->simplePaginate(6);
        }

        return view('user.shop',['product' => $products, 'category' => $categories]);
    }
}