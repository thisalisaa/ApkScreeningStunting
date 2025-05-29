@extends('layouts.petugas_posyandu')

@section('title', 'Tambah Data Pengukuran')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas-posyandu.data-pengukuran') }}">Data Pengukuran</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data Pengukuran</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold mb-0">Tambah Data Pengukuran</h5>
        </div>
        <div class="card-body">

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form id="add-form" action="{{ route('petugas-posyandu.data-pengukuran.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_balita" id="balitaId" value="{{ isset($balita) ? $balita->id : '' }}">
                <input type="hidden" id="usiaBulanField" value="{{ $umurBulan }}">
                <input type="hidden" id="tanggalLahir" value="{{ isset($balita) ? $balita->tanggal_lahir : '' }}">
                <input type="hidden" name="bulan" value="{{ $filterBulan }}">
                <input type="hidden" name="tahun" value="{{ $filterTahun }}">


                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Nama Balita</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="balitaNama" name="nama_balita"
                            value="{{ isset($balita) ? $balita->nama_balita : '' }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Usia Balita (Bulan)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="usia_bulan" value="{{ $umurBulan }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tanggalPengukuran" class="col-sm-3 col-form-label">Tanggal Pengukuran</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control @error('tanggal_pengukuran') is-invalid @enderror"
                            id="tanggalPengukuran" name="tanggal_pengukuran"
                            value="{{ old('tanggal_pengukuran', date('Y-m-d')) }}" >
                        @error('tanggal_pengukuran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="beratBadan" class="col-sm-3 col-form-label">Berat Badan (kg)</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.1" placeholder="Contoh: 12.5"
                            class="form-control @error('berat_badan') is-invalid @enderror" id="beratBadan"
                            name="berat_badan" value="{{ old('berat_badan') }}" >
                        @error('berat_badan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tinggiBadan" class="col-sm-3 col-form-label">Tinggi Badan (cm)</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.1" placeholder="Contoh: 85.2"
                            class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggiBadan"
                            name="tinggi_badan" value="{{ old('tinggi_badan') }}" >
                        @error('tinggi_badan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3" id="field_asi_ekslusif" style="display: none;">
                    <label for="asi_ekslusif" class="col-sm-3 col-form-label">ASI Eksklusif</label>
                    <div class="col-sm-9">
                        <select name="asi_ekslusif" id="asi_ekslusif"
                            class="form-select @error('asi_ekslusif') is-invalid @enderror">
                            <option value="">Pilih</option>
                            <option value="1" {{ old('asi_ekslusif') == '1' ? 'selected' : '' }}>Ya</option>
                            <option value="0" {{ old('asi_ekslusif') == '0' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('asi_ekslusif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3" id="field_mpasi" style="display: none;">
                    <label for="mpasi" class="col-sm-3 col-form-label">MPASI</label>
                    <div class="col-sm-9">
                        <select name="mpasi" id="mpasi" class="form-select @error('mpasi') is-invalid @enderror">
                            <option value="">Pilih</option>
                            <option value="1" {{ old('mpasi') == '1' ? 'selected' : '' }}>Baik</option>
                            <option value="2" {{ old('mpasi') == '2' ? 'selected' : '' }}>Tidak Baik</option>
                        </select>
                        @error('mpasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-9 offset-sm-3">
                        <a href="{{ route('petugas-posyandu.data-pengukuran') }}" class="btn btn-info">CANCEL</a>
                        <button type="submit" class="btn btn-success">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const usiaBulan = parseInt(document.getElementById('usiaBulanField').value);
            const asiField = document.getElementById('field_asi_ekslusif');
            const mpasiField = document.getElementById('field_mpasi');

            if (!isNaN(usiaBulan)) {
                // Jika usia 0–5 bulan, tampilkan hanya field ASI
                if (usiaBulan >= 0 && usiaBulan < 6) {
                    asiField.style.display = 'flex';
                    mpasiField.style.display = 'none';
                    // Jika usia tepat 6 bulan, tampilkan keduanya (ASI & MPASI)
                } else if (usiaBulan === 6) {
                    asiField.style.display = 'flex';
                    mpasiField.style.display = 'flex';
                    // Jika usia 7–23 bulan, tampilkan hanya field MPASI
                } else if (usiaBulan > 6 && usiaBulan <= 23) {
                    asiField.style.display = 'none';
                    mpasiField.style.display = 'flex';
                    // Jika usia lebih dari 23 bulan, sembunyikan keduanya
                } else {
                    asiField.style.display = 'none';
                    mpasiField.style.display = 'none';
                }
            }

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#add-form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Success:', response);
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data berhasil ditambahkan.",
                            icon: "success"
                        }).then(function() {
                            window.location.href =
                            .location.href = "{{ route('petugas-posyandu.data-pengukuran') }}?bulan=" + bulan + "&tahun=" + tahun;

                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', xhr);
                        var errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                        var errorMessages = '';

                        if (errors) {
                            $.each(errors, function(key, value) {
                                errorMessages += value[0] + '<br>';
                            });
                        } else {
                            errorMessages = "Terjadi kesalahan pada server: " + error;
                        }

                        Swal.fire({
                            title: "Gagal!",
                            html: errorMessages,
                            icon: "error"
                        });
                    }
                });
            });
        });
    </script>
@endpush
