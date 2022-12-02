@extends('layouts.navbar')

@section('content')
<div class="text-center">
    <h3>Postingan</h3>
</div>
<div class="mb-3">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
</div>
<table class="table table-hover text-center">
    <thead class="bg-dark text-white">
        <tr>
            <th>ID Post</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tanggal dibuat</th>
            <th>Kategori</th>
            @if(Auth::user()->role == 'admin')
            <th>Ditampilkan</th>                
            @endif
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->judul }}</td>
            <td>{{ $d->penulis }}</td>
            <td>{{ $d->tgl_dibuat }}</td>
            <td>{{ $d->kategori->nama_kategori }}</td>
            @if(Auth::user()->role == 'admin')
            <td>
                @if($d->tampil == 1)
                <span class="text-primary fw-semibold">Ditampilkan</span>
                @else
                <span class="text-danger fw-semibold">Tidak ditampilkan</span>
                @endif
            </td>                
            @endif
            <td>
                <a href="{{ route('post.show', $d->id) }}" class="btn btn-secondary">Lihat</a>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $d->id }}">Edit</button>
                <form action="{{ route('post.destroy', $d->id) }}" method="POST" style="display: inline-block">
                    @csrf
                    @method('delete')
                    <a href="#" onclick="return confirm('Yakin hapus Data ?')"> <button class="text-white btn btn-danger">Hapus</button> </a>
                </form>
            </td>
        </tr>
        {{-- Modal edit start --}}
        <div class="modal fade" id="exampleModal{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit postingan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('post.update',$d->id) }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="judul" value="{{ $d->judul }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Penulis</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="penulis" value="{{ $d->penulis }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Isi</label>
                                <textarea name="isi" class="form-control" id="" cols="30" rows="10">{{ $d->isi }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Tanggal dibuat</label>
                                <input type="date" class="form-control" id="exampleFormControlInput1" name="tgl_dibuat" value="{{ $d->tgl_dibuat }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Kategori</label>
                                <select name="kategori_id" id="" class="form-select">
                                    <option value="" selected disabled>-- Pilih kategori --</option>
                                    @foreach($kategori as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $d->kategori_id? 'selected' :'' }}>{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if(Auth::user()->role == 'admin')
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" {{ $d->tampil == 1 ? 'checked':'' }} name="tampil" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Tampilkan postingan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" {{ $d->tampil == 0 ? 'checked':'' }} name="tampil" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">Sembunyikan postingan</label>
                                </div>
                            </div>                                
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal edit end --}}
        @endforeach
    </tbody>
</table>

{{-- modal add --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah postingan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('post.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="judul">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="penulis">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Isi</label>
                        <textarea name="isi" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Tanggal dibuat</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" name="tgl_dibuat">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Kategori</label>
                        <select name="kategori_id" id="" class="form-select">
                            <option value="" selected disabled>-- Pilih kategori --</option>
                            @foreach($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- modal add --}}
@endsection