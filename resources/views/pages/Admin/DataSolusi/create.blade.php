@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.data-solusi') }}">Data Solusi</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data Solusi</li>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold mb-0">Tambah Data Solusi</h5>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-solusi') }}" method="POST">
            @csrf
            
            <!-- Saran Input -->
            <div class="row mb-3">
                <label for="saran" class="col-sm-3 col-form-label">Saran</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="saran" name="saran" rows="3" placeholder="Masukkan saran" required></textarea>
                </div>
            </div>

            <!-- Tingkat Resiko Input -->
            <div class="row mb-3">
                <label for="resiko" class="col-sm-3 col-form-label">Tingkat Resiko</label>
                <div class="col-sm-9">
                    <select class="form-control" id="resiko" name="resiko" required>
                        <option value="" selected disabled>Pilih Tingkat Resiko</option>
                        <option value="normal">Normal</option>
                        <option value="rendah">Rendah</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="sangat tinggi">Sangat Tinggi</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <a href="{{ route('admin.data-solusi') }}" class="btn btn-info">CANCEL</a>
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection