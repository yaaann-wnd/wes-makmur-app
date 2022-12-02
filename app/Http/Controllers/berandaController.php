<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\produk;
use Illuminate\Http\Request;

class berandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // menampilkan postingan di beranda
        $data = post::all()->where('tampil', 1);
        
        return view('home', compact('data'));
    }
    
    public function produk(){
        // menampilkan produk di beranda
        $data = produk::all()->where('tampil', 1);

        return view('produk', compact('data'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // menampilkan detail postingan dan menampilkan rekomendasi
        $data = post::findOrFail($id);
        $produk = produk::all()->where('kategori_id', $data->kategori_id)->where('tampil', 1);

        return view('detail', compact('data', 'produk'));

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
    public function update(Request $request, $id)
    {
        //
    }

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
}
