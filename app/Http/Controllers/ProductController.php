<?php

namespace App\Http\Controllers;

use App\Product;
use App\Product_Categories;
use App\Product_Category_Details;
use App\Product_Image;
use App\Discount;
use App\Product_Review;
use App\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();
        return view('product.product',compact('data'));
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
    public function store(Request $request)
    {  
        $request->validate([
            'product_images' => ['required'],
            'product_images.*' => [ 'mimes:jpg,jpeg,png', 'max:2000'],
            'product_name' => ['required','max:100'],
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'description' => ['required'],
            'product_rate' => ['required','max:100'],
            'stock' => ['required', 'max:10'],
            'weight' => ['required', 'max:3'],

        ]);

        if($request->hasFile('product_images')){

            $product = new Product;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->product_rate = $request->product_rate;
            $product->stock = $request->stock;
            $product->weight = $request->weight;
            $product->save();


            $product = DB::table('products')->where('product_name','=', $request->product_name)->first();
            foreach($request->file('product_images') as $file){
                $name = rand(1000,9999) . '_.' . $file->extension();
                $file->storeAs('/img/gambarproduk', $name);
                $image = new Product_Image();
                $image->product_id= $product->id;
                $image->image_name=$name;
                $image->save();
            }
            return redirect("/products")->with('success','Data Tersimpan');
        }

       return redirect()->back()->withInput($request->only('product_name', 'price', 'description', 'product_rate', 'stock', 'weight'))->with('error', 'Please fill in all fields with valid value');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $image = DB::table('product_images')->where('product_id','=',$id)->paginate(5);
        $product_categories= DB::table('product_categories')->get();
        $product_category_details = Product_Category_Details::where('product_id', '=', $id)->with('product_categories')->paginate(10);
        $product_review = Product_Review::where('product_id', '=', $id)->paginate(10);
        $discount = Discount::where('id_product', '=', $id)->paginate(10);
        return view('product.editproduct', compact('product','image', 'product_categories', 'product_category_details', 'product_review', 'discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = new Product();
        $product = Product::find($id);

        $request->validate([
            'product_name' => ['required', 'max:100'],
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'description' => ['required'],
            'product_rate' => ['required', 'max:100'],
            'stock' => ['required', 'max:10'],
            'weight' => ['required', 'max:3'],
        ]);

        $product->product_name= $request->product_name;
        $product->price= $request->price;
        $product->description= $request->description;
        $product->product_rate= $request->product_rate;
        $product->stock= $request->stock;
        $product->weight= $request->weight;
        $product->save();
        return redirect("/products")->with('edits','Data Berhasil dirubah');;
    }

    public function add_image(Request $request, $id)
    {
        $request->validate([
            'product_images' => ['required'],
            'product_images.*' => ['mimes:jpg,jpeg,png', 'max:2000'],
        ]);


        foreach($request->file('product_images') as $file){
                $name = time() . '_.' . $file->extension();
                $file->storeAs('/img/gambarproduk', $name);
                $image = new Product_Image();
                $image->product_id= $id;
                $image->image_name=$name;
                $image->save();
            }
        if (file_exists('product_images/'.$name)) {
            return redirect()->intended(route('product.edit', ['id' => $id]))->with("success", "Successfully Add Image");
        } 

       return redirect()->intended(route('product.edit', ['id' => $id]))->with('error', 'Please fill in all fields with valid value');
    

    }

    public function add_cat(Request $request, $id)
    {
        $request->validate([
            'product_category' => ['required'],
        ]);
        
        $pro_cat = new Product_Category_Details();
        $pro_cat->product_id = $id;
        $pro_cat->category_id = $request->product_category;
        if ( $pro_cat->save()) {
            return redirect()->intended(route('product.edit', ['id' => $id]))->with("success", "Successfully Add Category");
        }
        return redirect()->intended(route('product.edit', ['id' => $id]))->with('error', 'Please fill in all fields with valid value');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->relasi_product_image()->delete();
        $product->product_review()->delete();
        $product->discount()->delete();
        $product->product_category_details()->delete();
        $product->delete();
        return redirect("/products")->with('delete','Data Barang Berhasil Dihapus');;
    }

    public function delete_image($id)
    {
        
        $product_image = Product_Image::find($id);
        $product_id = $product_image->product_id;
        $path = 'product_images/'. $product_image->image_name;
        if(file_exists($path)){
            unlink($path);
            $product_image->delete();
            return redirect()->intended(route('product.edit', ['id' => $product_id]))->with("success", "Successfully Delete Image");
        }
        return redirect()->intended(route('product.edit', ['id' => $product_id]))->with('error', 'Failed to delete file');
    }

    public function delete_cat($id)
    {
        $product_category_details = Product_Category_Details::find($id);
        $product_id = $product_category_details->product_id;
        
        $product_category_details->delete();
        return redirect()->intended(route('product.edit', ['id' => $product_id]))->with("success", "Successfully Delete Category");
    }

}



