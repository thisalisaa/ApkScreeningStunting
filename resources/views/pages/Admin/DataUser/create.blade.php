@extends('layouts.admin')

@section('title', 'Tambah User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.data-user') }}">Data User</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold mb-0">Tambah User</h5>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.data-user.store') }}" method="POST">
                @csrf

                <!-- Nama User -->
                <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan Nama User" required>
                    </div>
                </div>

                <!-- Email User -->
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Masukkan Email" required>
                    </div>
                </div>

                <!-- Role User -->
                <div class="row mb-3">
                    <label for="role" class="col-sm-3 col-form-label">Role</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="role" name="role" required>
                            <option value="" selected disabled>Pilih Role User</option>
                            <option value="admin">Admin</option>
                            <option value="petugas_puskesmas">Petugas Puskesmas</option>
                            <option value="petugas_posyandu">Petugas Posyandu</option>
                        </select>
                    </div>
                </div>

                <!-- Puskesmas -->
                <div class="row mb-3">
                    <label for="id_puskesmas" class="col-sm-3 col-form-label">Puskesmas</label>
                    <div class="col-sm-9">
                        <select class="form-select @error('id_puskesmas') is-invalid @enderror" id="id_puskesmas"
                            name="id_puskesmas" required>
                            <option value="" selected disabled>Pilih Puskesmas</option>
                            @foreach ($puskesmas as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('id_puskesmas') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_puskesmas }}
                                </option>
                            @endforeach

                        </select>
                        @error('id_puskesmas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Posyandu -->
                <div class="row mb-3">
                    <label for="id_posyandu" class="col-sm-3 col-form-label">Posyandu</label>
                    <div class="col-sm-9">
                        <select class="form-select @error('id_posyandu') is-invalid @enderror" id="id_posyandu"
                            name="id_posyandu">
                            <option value="" selected disabled>Pilih Posyandu</option>
                            @foreach ($posyandu as $item)
                                <option value="{{ $item->id }}" {{ old('id_posyandu') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_posyandu }}
                                </option>
                            @endforeach

                        </select>
                        @error('id_posyandu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
                </div>

                <!-- Submit Button -->
                <div class="row">
                    <div class="col-sm-9 offset-sm-3">
                        <a href="{{ route('admin.data-user') }}" class="btn btn-info">CANCEL</a>
                        <button type="submit" class="btn btn-success">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
