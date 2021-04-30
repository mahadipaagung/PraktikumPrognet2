<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discount=Discount::with('Product')->paginate('15');
        
        return view('layout.admin.discount',compact('discount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = Product::all();
        return view('discount.discount',compact('product','id'));
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
            'percentage' => ['required', 'between:0,99.99'],
            'start' => ['required'],
            'end' => ['required']
        ]);

        $discount = new Discount();
        $discount->id_product = $request->id_product;
        $discount->percentage = $request->percentage;
        $discount->start = $request->start;
        $discount->end = $request->end;
        
        if($discount->save()){
            return redirect()->intended(route('product.edit',['id'=> $request->id_product]))->with("success", "Successfully Add Discount");
        }
        return redirect()->back()->withInput($request->only('percentage', 'start', 'end'))->with("error", "Failed Add Discount");

    }

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
    public function edit(discount $discount)
    {
        $product = Product::all();
        return view('discount.editdiscount',compact('discount','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_product' => ['required'],//wajib diisi
            'percentage' => ['required', 'between:0,99.99'],
            'start' => ['required'],
            'end' => ['required']
        ]);
        $discount = Discount::find($id);
        $discount->id_product = $request->id_product;
        $discount->percentage = $request->percentage;
        $discount->start = $request->start;
        $discount->end = $request->end;
        $discount->save();
        return redirect("/products");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);
        $discount->delete();
        return redirect()->back()->with("success", "Successfully Delete Discount");
    }
}
