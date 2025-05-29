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
            <form action="{{ route('admin.data-himpunan.store') }}" method="POST">
                @csrf

                <!-- Faktor Resiko Selection -->
                <div class="row mb-3">
                    <label for="faktor_resiko_id" class="col-sm-3 col-form-label">Faktor Resiko Stunting</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="faktor_resiko_id" name="faktor_resiko_id" required>
                            <option value="" selected disabled>Pilih Faktor</option>
                            @foreach ($faktors as $faktor)
                                <option value="{{ $faktor->id }}">{{ $faktor->nama_faktor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama_himpunan" class="col-sm-3 col-form-label">Nama Himpunan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_himpunan" name="nama_himpunan"
                            placeholder="Contoh: Rendah, Sedang, Tinggi" required>
                    </div>
                </div>

                 <div class="row mb-3">
                    <label for="satuan" class="col-sm-3 col-form-label">Satuan</label>
                    <div class="col-sm-9">
                        <input type="text"  class="form-control" id="satuan" name="satuan" placeholder="Contoh: kg">
                        <small class="form-text text-muted">* Isi jika memiliki satuan</small>
                    </div>
                </div>

                <!-- Tipe Fungsi Selection -->
                <div class="row mb-3">
                    <label for="tipe_fungsi" class="col-sm-3 col-form-label">Tipe Fungsi</label>
                    <div class="col-sm-9">
                        <select name="tipe_fungsi" id="tipe_fungsi" class="form-select">
                            <option value="">Pilih Tipe Fungsi</option>
                            <option value="segitiga">Segitiga</option>
                            <option value="trapesium">Trapesium</option>
                        </select>
                    </div>
                </div>

                <!-- Tipe Input Selection -->
                <div class="row mb-3">
                    <label for="tipe_input" class="col-sm-3 col-form-label">Tipe Input</label>
                    <div class="col-sm-9">
                        <select name="tipe_input" class="form-select" required>
                            <option value="numerik">Numerik</option>
                            <option value="diskrit">Pilihan (Ya/Tidak)</option>
                        </select>
                    </div>
                </div>

                <!-- Batas Bawah -->
                <div class="row mb-3">
                    <label for="batas_bawah" class="col-sm-3 col-form-label">Batas Bawah</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="batas_bawah" name="batas_bawah"
                            placeholder="Nilai batas bawah" step="0.01">
                    </div>
                </div>

                <!-- Batas Tengah 1 -->
                <div class="row mb-3">
                    <label for="batas_tengah1" class="col-sm-3 col-form-label">Batas Tengah 1</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="batas_tengah1" name="batas_tengah1"
                            placeholder="Nilai batas tengah pertama" step="0.01">
                    </div>
                </div>

                <!-- Batas Tengah 2 -->
                <div class="row mb-3">
                    <label for="batas_tengah2" class="col-sm-3 col-form-label">Batas Tengah 2</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" class="form-control" id="batas_tengah2" name="batas_tengah2" placeholder="Nilai batas tengah kedua" step="0.01">
                        <small class="form-text text-muted">* Isi jika tipe fungsi adalah <strong>Trapesium</strong></small>
                    </div>
                </div>

                <!-- Batas Atas -->
                <div class="row mb-3">
                    <label for="batas_atas" class="col-sm-3 col-form-label">Batas Atas</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="batas_atas" name="batas_atas" step="0.01"
                            placeholder="Nilai batas atas">
                    </div>
                </div>

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

@push('scripts')

<script>
    document.getElementById('tipe_fungsi').addEventListener('change', function () {
        const tipe = this.value;
        const tengah2 = document.getElementById('batas_tengah2').parentElement.parentElement;
        if (tipe === 'trapesium') {
            tengah2.style.display = 'flex';
        } else {
            tengah2.style.display = 'none';
            document.getElementById('batas_tengah2').value = '';
        }
    });
</script>

    
@endpush

