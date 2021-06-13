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
        $data=Discount::with('product')->get();
        return view ('discount.discount',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            'product_id' => ['required'],  
            'percentage' => ['required', 'between:0,99.99'],
            'start' => ['required', 'before_or_equal:end'],
            'end' => ['required', 'after_or_equal:start']
        ]);


        $discountcek = Discount::where('id_product', '=', $request->product_id)->get();

        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));

        foreach($discountcek as $dsc){
            $dscstart = date('Y-m-d', strtotime($dsc->start));
            $dscend = date('Y-m-d', strtotime($dsc->end));
            if($dscstart <= $start && $dscend >= $start || $dscstart <= $end && $dscend >= $end){
                return redirect('/admin/products/edit/'.$request->product_id)->with('failed','Data Tidak Tersimpan');
            }
        }
        
        $discount = new Discount();
        $discount->id_product = $request->product_id;
        $discount->percentage = $request->percentage;
        $discount->start = $request->start;
        $discount->end = $request->end;
        $discount->save();
        return redirect('/admin/products/edit/'.$request->product_id)->with('success','Data Tersimpan');

        // return redirect()->back()->withInput($request->only('percentage', 'start', 'end'))->with("error", "Failed Add Discount");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        $discount = Discount::find($id);
        return view('discount.editdiscount',compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'percentage' => ['required', 'between:0,99.99'],
            'start' => ['required', 'before_or_equal:end'],
            'end' => ['required', 'after_or_equal:start']
        ]);

        $discount = Discount::find($request->id);

        $discountcek = Discount::where('id', '!=', $request->id)->get();

        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));

        foreach($discountcek as $dsc){
            $dscstart = date('Y-m-d', strtotime($dsc->start));
            $dscend = date('Y-m-d', strtotime($dsc->end));
            if($dscstart <= $start && $dscend >= $start || $dscstart <= $end && $dscend >= $end){
                return redirect('/admin/products/edit/'.$discount->id_product)->with('failed1','Data Tidak Tersimpan');
            }
        }

        $discount->percentage = $request->percentage;
        $discount->start = $request->start;
        $discount->end = $request->end;
        $discount->save();
        return redirect('/admin/products/edit/'.$discount->id_product)->with('edits','Data Berhasil dirubah');
        
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
        return redirect()->back()->with("delete", "Successfully Delete Discount");
    }
}
