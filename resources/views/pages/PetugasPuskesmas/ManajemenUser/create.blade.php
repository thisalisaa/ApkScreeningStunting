@extends('layouts.petugas_puskesmas')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas-puskesmas.manajemen-user') }}">Manajemen User</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Akun User</li>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold mb-0">Tambah Akun User</h5>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('petugas-puskesmas.manajemen-user') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="row mb-3">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>
            </div>

            <!-- Email -->
            <div class="row mb-3">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan alamat email" required>
                </div>
            </div>

            <!-- Posyandu -->
            <div class="row mb-3">
                <label for="posyandu_id" class="col-sm-3 col-form-label">Pilih Posyandu</label>
                <div class="col-sm-9">
                    <select class="form-control" id="posyandu_id" name="posyandu_id" required>
                        <option value="" disabled selected>Pilih Posyandu</option>
                        <option value="" disabled selected>Posyandu Mawar</option>
                        <option value="" disabled selected>Posyandu Anggrek</option>

                    </select>
                </div>
            </div>

            <!-- Tombol -->
            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <a href="{{ route('petugas-puskesmas.manajemen-user') }}" class="btn btn-info">CANCEL</a>
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
