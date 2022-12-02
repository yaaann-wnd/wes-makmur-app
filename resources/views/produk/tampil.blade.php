@extends('layouts.navbar')

@section('content')
<div class="text-center">
    <h3>Produk</h3>
</div>
<div class="mb-3">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
</div>
<table class="table table-hover text-center">
    <thead class="bg-dark text-white">
        <tr>
            <th>ID Produk</th>
            <th>Nama Produk</th>
            <th>Deskripsi Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Foto</th>
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
            <td>{{ $d->nama_produk }}</td>
            <td>{{ $d->desc_produk }}</td>
            <td>{{ $d->kategori->nama_kategori }}</td>
            <td>{{ $d->harga }}</td>
            <td><img src="{{ asset('storage/'.$d->foto) }}" class="rounded" width="75px" alt=""></td>
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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $d->id }}">Edit</button>
                <form action="{{ route('produk.destroy', $d->id) }}" method="POST" style="display: inline-block">
                    @csrf
                    @method('delete')
                    <a href="#" onclick="return confirm('Yakin hapus Data ?')"> <button class="text-white btn btn-danger">Hapus</button> </a>
                </form>
            </td>
        </tr>
        {{-- Modal edit start --}}
        <div class="modal fade" id="exampleModal{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('produk.update',$d->id) }}" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Nama produk</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="nama_produk" value="{{ $d->nama_produk }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi produk</label>
                                <textarea name="desc_produk" class="form-control" id="" cols="30" rows="10">{{ $d->desc_produk }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Kategori</label>
                                <select name="kategori_id" id="" class="form-select">
                                    <option value="" selected disabled>-- Pilih kategori --</option>
                                    @foreach($kategori as $k)
                                    <option value="{{ $k->id }}" {{ $k->id == $d->kategori_id? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="validationDefaultUsername" class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend2">Rp</span>
                                    <input type="number" name="harga" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required value="{{ $d->harga }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="exampleFormControlInput1" name="foto">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Foto sebelumnya</label>
                                <img src="{{ asset('storage/'.$d->foto) }}" class="rounded d-block" width="75px" alt="">
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-check-inline {{ Auth::user()->role == 'admin'? '':'d-none' }}">
                                    <input class="form-check-input" type="radio" {{ $d->tampil == 1 ? 'checked':'' }} name="tampil" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Tampilkan produk</label>
                                </div>
                                <div class="form-check form-check-inline {{ Auth::user()->role == 'admin'? '':'d-none' }}">
                                    <input class="form-check-input" type="radio" {{ $d->tampil == 0 ? 'checked':'' }} name="tampil" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">Sembunyikan produk</label>
                                </div>
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
        {{-- Modal edit end --}}
        @endforeach
    </tbody>
</table>

{{-- modal add --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Nama produk</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="nama_produk">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi produk</label>
                        <textarea name="desc_produk" class="form-control" id="" cols="30" rows="10"></textarea>
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
                    {{-- <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Harga</label>
                        <input type="number" min="1" class="form-control" id="exampleFormControlInput1" name="harga">
                    </div> --}}
                    <div class="mb-3">
                        <label for="validationDefaultUsername" class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend2">Rp</span>
                            <input type="number" name="harga" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="exampleFormControlInput1" name="foto">
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
