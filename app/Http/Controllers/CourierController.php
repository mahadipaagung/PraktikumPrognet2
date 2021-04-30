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
        $cr = new Courier;
        $cr->courier = $request->courier;
        $cr->save();
        return redirect('/courier')->with('success','Data Tersimpan');
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
    public function edit(Courier $courier) //method untuk menampilkan halaman edit
    {
        $courier = Courier::find($courier)->first();
        return view('courier.editcourier',compact('courier')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courier $courier) //method untuk mengupdate data di database
    {
        $courier->courier = $request->courier;
        $courier->save();
        return redirect('/courier')->with('edits','Data Berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courier $courier) //method untuk menghapus data
    {
        $courier->delete($courier);
        return redirect('/courier')->with('delete','Data Barang Berhasil Dihapus');
    }
}
