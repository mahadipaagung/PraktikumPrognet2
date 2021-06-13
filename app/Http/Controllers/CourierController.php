<?php

namespace App\Http\Controllers;

use App\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //method menampilkan halaman utama
    {
        $data=Courier::all();
        return view ('courier.courier',compact(['data']));
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
    public function store(Request $request) //method untuk input data ke database
    {
        $test = Courier::where('code' , $request->code)->get();
        if (count($test)>0){
            return redirect('/admin/courier')->with('failed','Data Sudah Ada');
        }else{
            $cr = new Courier;
            $cr->code = $request->code;
            $cr->courier = $request->courier;
            $cr->save();
            return redirect('/admin/courier')->with('success','Data Tersimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function show(Courier $courier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //method untuk menampilkan halaman edit
    {
        $courier = Courier::find($id);
        return view('courier.editcourier',compact('courier')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) //method untuk mengupdate data di database
    {
        $test = Courier::where('code' , $request->code)->where('id','!=',$request->courier_id)->get();
        if (count($test)>0){
            return redirect('/admin/courier')->with('failed','Data Sudah Ada');
        }else{
            $courier = Courier::find($request->courier_id);
            $courier->courier = $request->courier;
            $courier->code = $request->code;
            $courier->save();
            return redirect('/admin/courier')->with('edits','Data Berhasil dirubah');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //method untuk menghapus data
    {
        $courier = Courier::find($id)->delete();
        return redirect('/admin/courier')->with('delete','Data Barang Berhasil Dihapus');
    }
}
