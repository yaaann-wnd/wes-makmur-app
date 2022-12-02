@extends('navbar')

@section('content')
<div class="mb-4">
    <div class="mb-3 text-center">
        <h3>Produk</h3>
    </div>
    @foreach($data as $d)
    <div class="card mb-3 p-4 rounded-4">
        <div class="d-flex align-items-center">
            <div class="me-3">
                <img src="{{ asset('storage/'.$d->foto) }}" class="rounded" width="75px" alt="">
            </div>
            <div class="w-50">
                <div class="row">
                    <span class="fw-semibold text-capitalize fs-3">{{ $d->nama_produk }}</span>
                </div>
                <div class="row">
                    <span>Deskripsi : <span class="text-capitalize fw-semibold">{{ $d->desc_produk }}</span></span>
                </div>
                <div class="row">
                    <span>Kategori : <span class="text-capitalize fw-semibold">{{ $d->kategori->nama_kategori }}</span></span>
                </div>
                <div class="row">
                    <span>Harga : <span class="text-capitalize fw-semibold">{{ $d->harga }}</span></span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection