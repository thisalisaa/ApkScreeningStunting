@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.data-himpunan') }}">Data Himpunan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Data Himpunan</li>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold mb-0">Detail Data Himpunan</h5>
            <a href="{{ route('admin.data-himpunan') }}" class="btn btn-info">
                <i class="ti ti-arrow-left"></i> CANCEL
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Faktor Resiko Display -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Faktor Resiko Stunting</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control-plaintext" value="Berat Badan Lahir" readonly>
                </div>
            </div>

            <!-- Nama Himpunan Display -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nama Himpunan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control-plaintext" value="Rendah" readonly>
                </div>
            </div>

            <!-- Batas Bawah Display -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Batas Bawah</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control-plaintext" value="0.00" readonly>
                </div>
            </div>

            <!-- Batas Tengah 1 Display -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Batas Tengah 1</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control-plaintext" value="1.50" readonly>
                </div>
            </div>

            <!-- Batas Tengah 2 Display -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Batas Tengah 2</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control-plaintext" value="2.50" readonly>
                </div>
            </div>

            <!-- Batas Atas Display -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Batas Atas</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control-plaintext" value="3.00" readonly>
                </div>
            </div>

            
        </div>
    </div>
</div>

@endsection