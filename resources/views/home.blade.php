@extends('navbar')

@section('content')
<div class="mb-4">
    <div class="mb-3 text-center">
        <h3>Postingan</h3>
    </div>
    @foreach($data as $d)
    <div class="card mb-3 p-4 rounded-4">
        <div class="d-flex align-items-center">
            <div>
                <div class="row">
                    <span class="fw-semibold text-capitalize fs-3">{{ $d->judul }}</span>
                </div>
                <div class="row">
                    <span>Tanggal dibuat : <span class="text-capitalize fw-semibold">{{ $d->tgl_dibuat }}</span></span>
                </div>
                <div class="row">
                    <span>Kategori : <span class="text-capitalize fw-semibold">{{ $d->kategori->nama_kategori }}</span></span>
                </div>
            </div>
            <div class="ms-auto">
                <span><a href="{{ route('beranda.show', $d->id) }}" class="btn btn-outline-primary rounded-3">Lihat postingan</a></span>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection