@extends('layouts.navbar')

@section('content')
    <div class="judul">
        <h2>{{ $data->judul }}</h2>
    </div>
    <div>
        <p class="fs-5">{{ $data->isi }}</p>
    </div>
@endsection