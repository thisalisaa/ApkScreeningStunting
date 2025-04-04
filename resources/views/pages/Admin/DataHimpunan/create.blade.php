@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.data-himpunan') }}">Data Himpunan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data Himpunan</li>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold mb-0">Tambah Data Himpunan</h5>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-himpunan') }}" method="POST">
            @csrf

            <!-- Faktor Resiko Selection -->
            <div class="row mb-3">
                <label for="faktor_resiko_id" class="col-sm-3 col-form-label">Faktor Resiko Stunting</label>
                <div class="col-sm-9">
                    <select class="form-control" id="faktor_resiko_id" name="faktor_resiko_id" required>
                        <option value="" selected disabled>Pilih Faktor Resiko</option>
                        <option value="" selected disabled>Berat Badan Lahir</option>
                    </select>
                </div>
            </div>

            <!-- Nama Himpunan -->
            <div class="row mb-3">
                <label for="nama_himpunan" class="col-sm-3 col-form-label">Nama Himpunan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_himpunan" name="nama_himpunan" placeholder="Contoh: Rendah, Sedang, Tinggi" required>
                </div>
            </div>

            <!-- Batas Bawah -->
            <div class="row mb-3">
                <label for="batas_bawah" class="col-sm-3 col-form-label">Batas Bawah</label>
                <div class="col-sm-9">
                    <input type="number" step="0.01" class="form-control" id="batas_bawah" name="batas_bawah" placeholder="Nilai batas bawah" required>
                </div>
            </div>

            <!-- Batas Tengah 1 -->
            <div class="row mb-3">
                <label for="batas_tengah1" class="col-sm-3 col-form-label">Batas Tengah 1</label>
                <div class="col-sm-9">
                    <input type="number" step="0.01" class="form-control" id="batas_tengah1" name="batas_tengah1" placeholder="Nilai batas tengah pertama" required>
                </div>
            </div>

            <!-- Batas Tengah 2 -->
            <div class="row mb-3">
                <label for="batas_tengah2" class="col-sm-3 col-form-label">Batas Tengah 2</label>
                <div class="col-sm-9">
                    <input type="number" step="0.01" class="form-control" id="batas_tengah2" name="batas_tengah2" placeholder="Nilai batas tengah kedua" required>
                </div>
            </div>

            <!-- Batas Atas -->
            <div class="row mb-3">
                <label for="batas_atas" class="col-sm-3 col-form-label">Batas Atas</label>
                <div class="col-sm-9">
                    <input type="number" step="0.01" class="form-control" id="batas_atas" name="batas_atas" placeholder="Nilai batas atas" required>
                </div>
            </div>


            <!-- Submit Button -->
            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <a href="{{ route('admin.data-himpunan') }}" class="btn btn-info">CANCEL</a>
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection