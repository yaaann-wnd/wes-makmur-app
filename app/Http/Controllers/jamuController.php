<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class jamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // menampilkan halaman rekomendasi jamu
        return view('jamu');
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
        // proses menampilkan rekomendasi jamu
        $keluhan = $request->keluhan;
        $tahun = $request->tahun;

        $tampil = new saran($keluhan, $tahun);

        $data = [
            'keluhan'=>$keluhan,
            'tahun'=>$tahun,
            'umur'=>$tampil->umur(),
            'jamu'=>$tampil->namaJamu(),
            'saran'=>$tampil->Saran(),
            'khasiat'=>$tampil->khasiat()
        ];

        return view('jamu', compact('data'));
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

// class untuk menampilkan rekomendasi jamu
class jamu {
    public function __construct($keluhan, $tahun) {
        $this->keluhan = $keluhan;
        $this->tahun = $tahun;
    }

    public function namaJamu(){
        $keluhan = $this->keluhan;

        if ($keluhan == 'Keseleo dan kurang nafsu makan') {
            return 'Beras kencur';
        } else if ($keluhan == 'Pegal-pegal') {
            return 'Kunyit asam';
        } else if($keluhan == 'Darah tinggi dan gula darah') {
            return 'Brotowali';
        } else if ($keluhan == 'Kram perut dan masuk angin') {
            return 'Temulawak';
        } else {
            return 'Terserah beliau mau minum apa';
        }
    }
}

class saran extends jamu{
    public function umur(){
        $tahun = $this->tahun;
        $tahunSekarang = date('Y');

        return $tahunSekarang - $tahun;

    }

    public function Saran(){
        $umur = $this->umur();
        $keluhan = $this->keluhan;
        $jamu = $this->namaJamu();

        if ($jamu == 'Beras kencur' && $keluhan == 'Keseleo dan kurang nafsu makan') {
            return 'Dioleskan';
        } else {
            if ($umur <= 10) {
                return 'Dikonsumsi 1x';
            } else {
                return 'Dikonsumsi 2x';
            }
        }
    }

    public function khasiat(){
        $jamu = $this->namaJamu();

        if ($jamu) {
            return 'Menyembuhkan '. $this->keluhan;
        } else {
            return 'Khasiat tidak ditemukan';
        }
    }
}