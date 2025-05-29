@extends('layouts.admin')

@section('title', 'Edit Data Himpunan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.data-himpunan') }}">Data Himpunan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Data Himpunan</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title fw-semibold mb-0">Edit Data Himpunan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-himpunan.update', $himpunan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Faktor Resiko -->
            <div class="row mb-3">
                <label for="faktor_resiko_id" class="col-sm-3 col-form-label">Faktor Resiko Stunting</label>
                <div class="col-sm-9">
                    <select class="form-select" id="faktor_resiko_id" name="faktor_resiko_id" required>
                        <option value="" disabled>Pilih Faktor</option>
                        @foreach ($faktors as $faktor)
                            <option value="{{ $faktor->id }}" {{ $faktor->id == $himpunan->faktor_resiko_id ? 'selected' : '' }}>
                                {{ $faktor->nama_faktor }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Nama Himpunan -->
            <div class="row mb-3">
                <label for="nama_himpunan" class="col-sm-3 col-form-label">Nama Himpunan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_himpunan" name="nama_himpunan" value="{{ $himpunan->nama_himpunan }}" required>
                </div>
            </div>

            <!-- Satuan -->
            <div class="row mb-3">
                <label for="satuan" class="col-sm-3 col-form-label">Satuan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $himpunan->satuan }}">
                    <small class="form-text text-muted">* Isi jika memiliki satuan</small>
                </div>
            </div>

            <!-- Tipe Fungsi -->
            <div class="row mb-3">
                <label for="tipe_fungsi" class="col-sm-3 col-form-label">Tipe Fungsi</label>
                <div class="col-sm-9">
                    <select name="tipe_fungsi" class="form-select" id="tipe_fungsi">
                        <option value="">Pilih Tipe Fungsi</option>
                        <option value="segitiga" {{ $himpunan->tipe_fungsi == 'segitiga' ? 'selected' : '' }}>Segitiga</option>
                        <option value="trapesium" {{ $himpunan->tipe_fungsi == 'trapesium' ? 'selected' : '' }}>Trapesium</option>
                    </select>
                </div>
            </div>

            <!-- Tipe Input -->
            <div class="row mb-3">
                <label for="tipe_input" class="col-sm-3 col-form-label">Tipe Input</label>
                <div class="col-sm-9">
                    <select name="tipe_input" class="form-select" required>
                        <option value="numerik" {{ $himpunan->tipe_input == 'numerik' ? 'selected' : '' }}>Numerik</option>
                        <option value="diskrit" {{ $himpunan->tipe_input == 'diskrit' ? 'selected' : '' }}>Pilihan (Ya/Tidak)</option>
                    </select>
                </div>
            </div>

            <!-- Batasan -->
            <div class="row mb-3">
                <label for="batas_bawah" class="col-sm-3 col-form-label">Batas Bawah</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="batas_bawah" value="{{ $himpunan->batas_bawah }}" step="0.01">
                </div>
            </div>

            <div class="row mb-3">
                <label for="batas_tengah1" class="col-sm-3 col-form-label">Batas Tengah 1</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="batas_tengah1" value="{{ $himpunan->batas_tengah1 }}" step="0.01">
                </div>
            </div>

            <div class="row mb-3">
                <label for="batas_tengah2" class="col-sm-3 col-form-label">Batas Tengah 2</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="batas_tengah2" id="batas_tengah2" value="{{ $himpunan->batas_tengah2 }}" step="0.01">
                    <small class="form-text text-muted">* Isi jika tipe fungsi adalah <strong>Trapesium</strong></small>
                </div>
            </div>

            <div class="row mb-3">
                <label for="batas_atas" class="col-sm-3 col-form-label">Batas Atas</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="batas_atas" value="{{ $himpunan->batas_atas }}" step="0.01">
                </div>
            </div>

            <!-- Tombol -->
            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <a href="{{ route('admin.data-himpunan') }}" class="btn btn-info">CANCEL</a>
                    <button type="submit" class="btn btn-success">UPDATE</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const tipeFungsi = document.getElementById('tipe_fungsi');
    const tengah2 = document.getElementById('batas_tengah2').parentElement.parentElement;

    function toggleTengah2() {
        if (tipeFungsi.value === 'trapesium') {
            tengah2.style.display = 'flex';
        } else {
            tengah2.style.display = 'none';
            document.getElementById('batas_tengah2').value = '';
        }
    }

    tipeFungsi.addEventListener('change', toggleTengah2);
    window.addEventListener('DOMContentLoaded', toggleTengah2);
</script>
@endpush
