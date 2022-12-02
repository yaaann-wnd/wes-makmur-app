@extends('navbar')

@section('content')
<div class="container">
    <div class="post-wrapper mb-5">
        <div class="judul mb-3">
            <h2>{{ $data->judul }}</h2>
            <p>Penulis : <span class="fw-semibold">{{ $data->penulis }}</span></p>
        </div>
        <div class="tgl">
            <span>Tanggal dibuat : {{ $data->tgl_dibuat }}</span>
        </div>
        <div class="tgl mb-4">
            <span>Kategori : {{ $data->kategori->nama_kategori }}</span>
        </div>
        <div class="isi">
            <p class="fs-5">{{ $data->isi }}</p>
        </div>
    </div>

    <div class="produk-wrapper mt-5">
        <div class="text-center mb-4">
            <h3>Rekomendasi produk</h3>
        </div>
        @foreach($produk as $p)
        <div class="card mb-3 p-4 rounded-4">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <img src="{{ asset('storage/'.$p->foto) }}" class="rounded" width="75px" alt="">
                </div>
                <div class="w-50">
                    <div class="row">
                        <span class="fw-semibold text-capitalize fs-3">{{ $p->nama_produk }}</span>
                    </div>
                    <div class="row">
                        <span>Kategori : <span class="text-capitalize fw-semibold">{{ $p->kategori->nama_kategori }}</span></span>
                    </div>
                    <div class="row">
                        <span>Harga : <span class="text-capitalize fw-semibold">{{ $p->harga }}</span></span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection