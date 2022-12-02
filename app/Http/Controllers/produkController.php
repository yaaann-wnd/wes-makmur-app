<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class produkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // menampilkan semua produk
        $data = produk::all();
        $kategori = kategori::all();

        return view('produk.tampil', compact('data', 'kategori'));
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
        // menambahkan produk
        $request->validate([
            'foto'=>'required|image|max:10000'
        ]);

        $file = $request->file('foto')->store('img');

        produk::create([
            'nama_produk'=>$request->nama_produk,
            'desc_produk'=>$request->desc_produk,
            'kategori_id'=>$request->kategori_id,
            'harga'=>$request->harga,
            'foto'=>$file,
        ]);

        return redirect('produk');
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
        // update produk
        $data = produk::findOrFail($id);

        $validator = $request->validate([
            'nama_produk'=>'required',
            'desc_produk'=>'required',
            'kategori_id'=>'required',
            'harga'=>'required',
            'tampil'=>'required',
        ]);

        $data->update($validator);

        if ($request->file('foto')) {
            $file = $request->file('foto')->store('img');

            Storage::delete($data->foto);

            $data->update([
                'foto'=>$file
            ]);

        } else {
            $data->update([
                'foto'=>$data->foto
            ]);

            return redirect('produk');
        }
        
        return redirect('produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // hapus produk
        $data = produk::findOrFail($id);

        if ($data->foto) {
            Storage::delete($data->foto);
        }

        $data->delete();

        return redirect('produk');
    }
}
