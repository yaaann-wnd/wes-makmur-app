@extends('navbar')

@section('content')
<div class="mb-4">
    <h3>Rekomendasi Jamu</h3>
</div>
<div class="card">
    <div class="card-header bg-dark text-white fw-semibold">
        Penemu jamu handal
    </div>
    <div class="card-body">
        <div class="row ">
            <div class="col">
                <div class="text-center mb-3">
                    <h4>Masukkan data</h4>
                </div>
                <form action="{{ route('jamu.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Keluhan</label>
                        <select name="keluhan" class="form-select" id="">
                            <option value="" disabled selected>-- Pilih keluhan --</option>
                            <option value="Keseleo dan kurang nafsu makan">Keseleo dan kurang nafsu makan</option>
                            <option value="Pegal-pegal">Pegal-pegal</option>
                            <option value="Darah tinggi dan gula darah">Darah tinggi dan gula darah</option>
                            <option value="Kram perut dan masuk angin">Kram perut dan masuk angin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tahun lahir</label>
                        <select name="tahun" class="form-select" id="">
                            <option value="" selected disabled>-- Pilih tahun lahir --</option>
                            @for($i = 1950; $i <= date('Y'); $i++) <option value="{{ $i }}" id="">{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary w-25" value="Kirim">
                    </div>
                </form>
            </div>
            <div class="col">
                <div class="text-center mb-3">
                    <h4>Hasil</h4>
                </div>
                <div class="mb-3">
                    Keluhan : @isset($data)<span class="fw-semibold">{{ $data['keluhan'] }}</span>@endisset
                </div>
                <div class="mb-3">
                    Tahun lahir : @isset($data)<span class="fw-semibold">{{ $data['tahun'] }}</span>@endisset
                </div>
                <div class="mb-3">
                    Umur : @isset($data)<span class="fw-semibold">{{ $data['umur'] }}</span>@endisset
                </div>
                <div class="mb-3">
                    Nama jamu : @isset($data)<span class="fw-semibold">{{ $data['jamu'] }}</span>@endisset
                </div>
                <div class="mb-3">
                    Saran penggunaan : @isset($data)<span class="fw-semibold">{{ $data['saran'] }}</span>@endisset
                </div>
                <div class="mb-3">
                    Khasiat : @isset($data)<span class="fw-semibold">{{ $data['khasiat'] }}</span>@endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
