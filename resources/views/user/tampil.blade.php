@extends('layouts.navbar')

@section('content')
<div class="text-center">
    <h3>User</h3>
</div>
<div class="mb-3">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
</div>
<table class="table table-hover text-center">
    <thead class="bg-dark text-white">
        <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->email }}</td>
            <td>{{ $d->role }}</td>
            <td>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $d->id }}">Edit</button>
                <form action="{{ route('user.destroy', $d->id) }}" method="POST" style="display: inline-block">
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit user</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('user.update',$d->id) }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Username</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{ $d->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="{{ $d->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Role</label>
                                <select name="role" id="" class="form-select">
                                    <option value="" disabled>-- Pilih role --</option>
                                    <option value="{{ $d->role }}" selected>{{ $d->role }}</option>
                                    @if($d->role == 'editor')
                                    <option value="user">User</option>
                                    @else
                                    <option value="editor">Editor</option>
                                    @endif
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
        {{-- Modal edit end --}}
        @endforeach
    </tbody>
</table>

{{-- modal add --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleFormControlInput1" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Role</label>
                        <select name="role" id="" class="form-select">
                            <option value="" selected disabled>-- Pilih role --</option>
                            <option value="editor">Editor</option>
                            <option value="user">User</option>
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