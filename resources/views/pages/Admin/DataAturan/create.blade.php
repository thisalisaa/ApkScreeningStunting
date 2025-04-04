@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.data-aturan') }}">Data Aturan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data Aturan</li>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold mb-0">Tambah Data Aturan</h5>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-aturan') }}" method="POST">
            @csrf

            <!-- Kode Aturan -->
            <div class="row mb-3">
                <label for="kode_aturan" class="col-sm-3 col-form-label">Kode Aturan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="kode_aturan" name="kode_aturan" placeholder="Contoh: R001" required>
                </div>
            </div>

            <!-- Nilai Z-Score -->
            <div class="row mb-3">
                <label for="z_score" class="col-sm-3 col-form-label">Nilai Z-Score</label>
                <div class="col-sm-9">
                    <select class="form-control" id="z_score" name="z_score" required>
                        <option value="" selected disabled>Pilih Nilai Z-Score</option>
                        <option value="rendah">Rendah</option>
                        <option value="normal">Normal</option>
                        <option value="tinggi">Tinggi</option>
                    </select>
                </div>
            </div>

            <!-- Berat Badan Lahir -->
            <div class="row mb-3">
                <label for="berat_badan_lahir" class="col-sm-3 col-form-label">Berat Badan Lahir</label>
                <div class="col-sm-9">
                    <select class="form-control" id="berat_badan_lahir" name="berat_badan_lahir" required>
                        <option value="" selected disabled>Pilih Berat Badan Lahir</option>
                        <option value="rendah">Rendah</option>
                        <option value="normal">Normal</option>
                    </select>
                </div>
            </div>

            <!-- ASI Eksklusif -->
            <div class="row mb-3">
                <label for="asi_eksklusif" class="col-sm-3 col-form-label">ASI Eksklusif</label>
                <div class="col-sm-9">
                    <select class="form-control" id="asi_eksklusif" name="asi_eksklusif" required>
                        <option value="" selected disabled>Pilih ASI Eksklusif</option>
                        <option value="tidak">Tidak</option>
                        <option value="ya">Ya</option>
                    </select>
                </div>
            </div>

            <!-- Pengetahuan Ibu -->
            <div class="row mb-3">
                <label for="pengetahuan_ibu" class="col-sm-3 col-form-label">Pengetahuan Ibu</label>
                <div class="col-sm-9">
                    <select class="form-control" id="pengetahuan_ibu" name="pengetahuan_ibu" required>
                        <option value="" selected disabled>Pilih Pengetahuan Ibu</option>
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                    </select>
                </div>
            </div>

            <!-- Pendapatan Keluarga -->
            <div class="row mb-3">
                <label for="pendapatan_keluarga" class="col-sm-3 col-form-label">Pendapatan Keluarga</label>
                <div class="col-sm-9">
                    <select class="form-control" id="pendapatan_keluarga" name="pendapatan_keluarga" required>
                        <option value="" selected disabled>Pilih Pendapatan Keluarga</option>
                        <option value="rendah">Rendah</option>
                        <option value="menengah">Menengah</option>
                        <option value="tinggi">Tinggi</option>
                    </select>
                </div>
            </div>

            <!-- Keputusan -->
            <div class="row mb-3">
                <label for="keputusan" class="col-sm-3 col-form-label">Keputusan</label>
                <div class="col-sm-9">
                    <select class="form-control" id="keputusan" name="keputusan" required>
                        <option value="" selected disabled>Pilih Keputusan</option>
                        <option value="stunting">Stunting</option>
                        <option value="tidak_stunting">Tidak Stunting</option>
                        <option value="beresiko_stunting">Beresiko Stunting</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <a href="{{ route('admin.data-aturan') }}" class="btn btn-info">CANCEL</a>

                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection