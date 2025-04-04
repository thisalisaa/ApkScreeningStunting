@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.data-posyandu') }}">Data Posyandu</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Posyandu</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold mb-0">Tambah Data Posyandu</h5>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-posyandu') }}" method="POST">
            @csrf

            <!-- Kode Posyandu -->
            <div class="row mb-3">
                <label for="kode_posyandu" class="col-sm-3 col-form-label">Kode Posyandu</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="kode_posyandu" name="kode_posyandu" 
                           placeholder="Contoh: PYD001" required>
                </div>
            </div>

            <!-- Nama Posyandu -->
            <div class="row mb-3">
                <label for="nama_posyandu" class="col-sm-3 col-form-label">Nama Posyandu</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_posyandu" name="nama_posyandu" 
                           placeholder="Contoh: Posyandu Melati" required>
                </div>
            </div>

            <!-- Kecamatan -->
            <div class="row mb-3">
                <label for="kecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                <div class="col-sm-9">
                    <select class="form-control" id="kecamatan" name="kecamatan" required>
                        <option value="" selected disabled>Pilih Kecamatan</option>
                        <option value="Lohbener">Lohbener</option>
                        <option value="Indramayu">Indramayu</option>
                        <option value="Jatibarang">Jatibarang</option>
                        <!-- Tambahkan kecamatan lainnya -->
                    </select>
                </div>
            </div>

            <!-- Desa -->
            <div class="row mb-3">
                <label for="desa" class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                <div class="col-sm-9">
                    <select class="form-control" id="desa" name="desa" required>
                        <option value="" selected disabled>Pilih Desa</option>
                        <!-- Options akan diisi via JavaScript -->
                    </select>
                </div>
            </div>

            <!-- Puskesmas -->
            <div class="row mb-3">
                <label for="puskesmas_id" class="col-sm-3 col-form-label">Puskesmas</label>
                <div class="col-sm-9">
                    <select class="form-control" id="puskesmas_id" name="puskesmas_id" required>
                        <option value="" selected disabled>Pilih Puskesmas</option>
                    </select>
                </div>
            </div>

            <!-- Alamat -->
            <div class="row mb-3">
                <label for="alamat" class="col-sm-3 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <a href="{{ route('admin.data-posyandu') }}" class="btn btn-info">
                    CANCEL
                    </a>
                    <button type="submit" class="btn btn-success">
                        SIMPAN
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Data desa berdasarkan kecamatan
        const desaByKecamatan = {
            'Lohbener': ['Lohbener', 'Segeran', 'Segeran Kidul', 'Waru', 'Anjatan'],
            'Indramayu': ['Indramayu', 'Pabean Udik', 'Dukuh', 'Karangsong', 'Lemahabang'],
            'Jatibarang': ['Jatibarang', 'Bulak', 'Jatibarang Baru', 'Kebulen', 'Pawidean']
        };

        // Ketika kecamatan dipilih
        $('#kecamatan').change(function() {
            const kecamatan = $(this).val();
            const desaSelect = $('#desa');
            
            desaSelect.empty().append('<option value="" selected disabled>Pilih Desa</option>');
            
            if (kecamatan && desaByKecamatan[kecamatan]) {
                desaByKecamatan[kecamatan].forEach(desa => {
                    desaSelect.append(`<option value="${desa}">${desa}</option>`);
                });
            }
        });
    });
</script>
@endpush