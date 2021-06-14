<?php

namespace App\Http\Controllers;
use App\Category;
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
use RealRashid\SweetAlert\Facades\Alert;
use Cviebrock\EloquentSluggable\Sluggable;
use Validator;
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
        $product = Product::all();
        return view('product.product',['products' => $product]);
    }

    public function showadd()
    {
        $categories = Category::all();
        return view('product.addproduct',['categories' => $categories]);
    }

    public function showbaru()
    {
        $products = Product::orderBy('id', 'desc')->take(3)->get();
        return view('home', ['products' => $products]);
    }

    public function showone($slug){

        $product = Product::where('slug','=',$slug)->first();
        if(!is_null($product)){
            return view('user.product', ['products' => $product]);
        }else{
            Alert::error('Product Not Found', 'You enter the wrong product information! Redirecting back to shop.');
            return redirect('/shop');
        }
        
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
            'product_name' => ['required'],
            'price' => ['required', 'min:1'],
            'description' => ['required'],
            'stock' => ['required', 'min:1'],
            'weight' => ['required', 'min:1'],
            'cat' => ['required'],
            'product_images' => ['max:20000'],
        ]);

        if($request->hasFile('product_images')){
            $product = new Product;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->product_rate = 0;
            $product->stock = $request->stock;
            $product->weight = $request->weight;
            $product->save();
    
            $product = Product::where('product_name','=', $request->product_name)->first();

            $pathhome = base_path();
            $path = $pathhome.'/public/uploads/product_images/';

            foreach($request->file('product_images') as $fil){
                $nama_awal = $fil->getClientOriginalName();
                $name = time()."_".$nama_awal;
                $fil->move($path,$name);
                $image = new Product_Image();
                $image->product_id= $product->id;
                $image->image_name=$name;
                $image->save();
            }

            foreach($request->cat as $ct){
                $pcd = new Product_Category_Details();
                $pcd->product_id= $product->id;
                $pcd->category_id=$ct;
                $pcd->save();
            }

        }else{
            $product = new Product;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->product_rate = 0;
            $product->stock = $request->stock;
            $product->weight = $request->weight;
            $product->save();
    
            $product = Product::where('product_name','=', $request->product_name)->first();
            foreach($request->cat as $ct){
                $pcd = new Product_Category_Details();
                $pcd->product_id= $product->id;
                $pcd->category_id=$ct;
                $pcd->save();
            }
        }
        
        return redirect("/admin/products")->with('success','Data berhasil ditambah');;
        Alert::success('Product Added', 'New product is added to the shop!');
    //    return redirect()->back()->withInput($request->only('product_name', 'price', 'description', 'product_rate', 'stock', 'weight'))->with('error', 'Please fill in all fields with valid value');
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
        $image = Product_Image::where('product_id','=',$id)->get();
        $product_categories= Product_Categories::all();
        $product_category_details = Product_Category_Details::where('product_id', '=', $id)->get();
 
        $product_review = Product_Review::where('product_id', '=', $id)->get();
        $discount = Discount::where('id_product', '=', $id)->get();
        return view('product.editproduct', compact('product','image', 'product_categories', 'product_category_details', 'product_review', 'discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_name' => ['required'],
            'price' => ['required', 'min:1'],
            'description' => ['required'],
            'stock' => ['required', 'min:1'],
            'weight' => ['required', 'min:1'],
            'cat' => ['required'],
        ]);

        $product = Product::find($request->product_id);
        $product->product_name= $request->product_name;
        $product->price= $request->price;
        $product->description= $request->description;
        $product->stock= $request->stock;
        $product->weight= $request->weight;
        $product->save();

        Product::find($request->product_id)->category()->sync($request->cat);

        return redirect("/admin/products/")->with('edits','Data berhasil dirubah');
        Alert::error('Product Edited', 'A product is changed to the shop!');
    }

    public function add_image(Request $request)
    {
        $request->validate([
            'product_images' => ['required','max:20000'],
        ]);
        
        $pathhome = base_path();
        $path = $pathhome.'/public/uploads/product_images/';
        
        foreach($request->file('product_images') as $fil){
            $nama_awal = $fil->getClientOriginalName();
            $name = time()."_".$nama_awal;
            $fil->move($path,$name);
            $image = new Product_Image();
            $image->product_id= $request->product_id;
            $image->image_name=$name;
            $image->save();
        }
        
        return redirect("/admin/products/edit/".$request->product_id);
    }

   //public function add_cat(Request $request, $id)
    // {
    //     $request->validate([
    //         'product_category' => ['required'],
    //     ]);
        
    //     $pro_cat = new Product_Category_Details();
    //     $pro_cat->product_id = $id;
    //     $pro_cat->category_id = $request->product_category;
    //     if ( $pro_cat->save()) {
    //         return redirect()->intended(route('product.edit', ['id' => $id]))->with("success", "Successfully Add Category");
    //     }
    //     return redirect()->intended(route('product.edit', ['id' => $id]))->with('error', 'Please fill in all fields with valid value');
    // }

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
        return redirect("/admin/products")->with('delete','Data berhasil dihapus');
    }

    public function delete_image($id)
    {
        Product_Image::destroy($id);
        return back();
    }

    public function delete_comment($id)
    {
        Product_Review::destroy($id);
        return back();
    }

    public function delete_cat($id)
    {
        Product_Category_Details::destroy($id);
        return back();
    }

}



