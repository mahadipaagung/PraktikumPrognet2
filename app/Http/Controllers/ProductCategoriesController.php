<?php

namespace App\Http\Controllers;
use App\Product_Category_Details;
use App\Product_Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Product_Categories::all();
        return view ('categories.categories',compact(['data']));
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
        $test = Product_Categories::where('category_name' , $request->category_name)->get();
        if (count($test)>0){
            return redirect('/admin/categories')->with('failed','Data Sudah Ada');
        }else{
            $ct = new Product_Categories;
            $ct->category_name = $request->category_name;
            $ct->save();
            return redirect('/admin/categories')->with('success','Data Tersimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product_Categories  $product_Categories
     * @return \Illuminate\Http\Response
     */
    public function show(Product_Categories $product_Categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product_Categories  $product_Categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pcat = Product_Categories::find($id);
        return view('categories.editcategories',compact('pcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product_Categories  $product_Categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'category_name' => ['required', 'max:30']
        ]);
        
        $test = Product_Categories::where('category_name' , $request->category_name)->get();
        if (count($test)>0){
            return redirect('/admin/categories')->with('failed','Data Sudah Ada');
        }else{
            $category = Product_Categories::find($request->id);
            $category->category_name= $request->category_name;
            $category->save();
            return redirect('/admin/categories')->with('edits','Data Berhasil dirubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product_Categories  $product_Categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pcat = Product_Categories::find($id);
        Product_Category_Details::where('category_id','=',$pcat->id)->delete();
        $pcat->delete();
        return redirect('/admin/categories')->with('delete','Data Category Berhasil Dihapus');
    }
}
