@extends('layouts.petugas_posyandu')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas-posyandu.data-balita') }}">Data Balita</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data Balita</li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/stepper.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('frontend/assets/js/stepper.js') }}"></script>
@endsection


@section('content')

    <div class="stepper mb-4">
        <div class="stepper-progress">
            <div class="stepper-progress-bar" role="progressbar" style="width: 33.33%;"></div>
        </div>
        <div class="stepper-nav">
            <button class="stepper-nav-item active" data-step="1">
                <i class="fas fa-check-circle"></i> Data Balita
            </button>
            <button class="stepper-nav-item" data-step="2">
                <i class="fas fa-check-circle"></i> Data Orang Tua
            </button>
            <button class="stepper-nav-item" data-step="3">
                <i class="fas fa-check-circle"></i> Data Kesehatan
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold mb-0">Tambah Data Balita</h5>
            </div>
        </div>
        <div class="card-body">
            <form id="add-form" action="{{ route('petugas-posyandu.data-balita.store') }}" method="POST">
                @csrf

                <!-- Step 1: Data Balita -->
                <div class="stepper-step" data-step="1">

                    <div class="row mb-3">
                        <label for="nama_balita" class="col-sm-3 col-form-label">Nama Balita</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nama_balita') is-invalid @enderror"
                                id="nama_balita" name="nama_balita" placeholder="Nama Balita">
                            @error('nama_balita')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="nik_balita" class="col-sm-3 col-form-label">NIK Balita</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nik_balita') is-invalid @enderror"
                                id="nik_balita" name="nik_balita" placeholder="Masukkan 16 digit angka NIK" maxlength="16"
                                pattern="\d{16}">
                            @error('nik_balita')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                                name="jenis_kelamin">
                                <option value="" selected disabled>Pilih jenis kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                placeholder="Masukkan alamat lengkap balita"></textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="berat_badan_lahir" class="col-sm-3 col-form-label">Berat Badan Lahir (kg)</label>
                        <div class="col-sm-9">
                            <input type="number" step="0.01"
                                class="form-control @error('berat_badan_lahir') is-invalid @enderror"
                                id="berat_badan_lahir" name="berat_badan_lahir" placeholder="Contoh: 4">
                            @error('berat_badan_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="panjang_badan_lahir" class="col-sm-3 col-form-label">Panjang Badan Lahir (cm)</label>
                        <div class="col-sm-9">
                            <input type="number" step="0.01"
                                class="form-control @error('panjang_badan_lahir') is-invalid @enderror"
                                id="panjang_badan_lahir" name="panjang_badan_lahir" placeholder="Contoh: 50">
                            @error('panjang_badan_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Step 2: Data Orang Tua -->
                <div class="stepper-step d-none" data-step="2">
                    <div class="row mb-3">
                        <label for="nama_ayah" class="col-sm-3 col-form-label">Nama Ayah</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                                id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah">
                            @error('nama_ayah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                                id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu">
                            @error('nama_ibu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="no_telepon" class="col-sm-3 col-form-label">No. Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                                id="no_telepon" name="no_telepon" placeholder="No.Telp">
                            @error('no_telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pekerjaan_ayah" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah">
                            @error('pekerjaan_ayah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pekerjaan_ibu" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu">
                            @error('pekerjaan_ibu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pendidikan_ayah" class="col-sm-3 col-form-label">Pendidikan Ayah</label>
                        <div class="col-sm-9">
                            <select class="form-control @error('pendidikan_ayah') is-invalid @enderror"
                                id="pendidikan_ayah" name="pendidikan_ayah">
                                <option value="">Pilih Pendidikan Ayah</option>
                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                            </select>
                            @error('pendidikan_ayah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pendidikan_ibu" class="col-sm-3 col-form-label">Pendidikan Ibu</label>
                        <div class="col-sm-9">
                            <select class="form-control @error('pendidikan_ibu') is-invalid @enderror"
                                id="pendidikan_ibu" name="pendidikan_ibu">
                                <option value="">Pilih Pendidikan Ibu</option>
                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                            </select>
                            @error('pendidikan_ibu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tinggi_badan_ayah" class="col-sm-3 col-form-label">Tinggi Badan Ayah (cm)</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('tinggi_badan_ayah') is-invalid @enderror"
                                id="tinggi_badan_ayah" name="tinggi_badan_ayah" placeholder="Contoh: 170">
                            @error('tinggi_badan_ayah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tinggi_badan_ibu" class="col-sm-3 col-form-label">Tinggi Badan Ibu (cm)</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('tinggi_badan_ibu') is-invalid @enderror"
                                id="tinggi_badan_ibu" name="tinggi_badan_ibu" placeholder="Contoh: 150">
                            @error('tinggi_badan_ibu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pendapatan_keluarga" class="col-sm-3 col-form-label">Pendapatan Keluarga (per
                            bulan)</label>
                        <div class="col-sm-9">
                            <select class="form-control @error('pendapatan_keluarga') is-invalid @enderror"
                                id="pendapatan_keluarga" name="pendapatan_keluarga">
                                <option value="">Pilih Pendapatan Keluarga</option>
                                <option value="< Rp2.000.000">
                                    < Rp2.000.000</option>
                                <option value="Rp2.000.000 - Rp4.000.000">Rp2.000.000 - Rp4.000.000</option>
                                <option value="> Rp4.000.000">> Rp4.000.000</option>
                            </select>
                            @error('pendapatan_keluarga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Step 3: Data Kesehatan -->
                <div class="stepper-step d-none" data-step="3">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Apakah terdapat riwayat penyakit?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="riwayat_penyakit"
                                    id="riwayat_penyakit_tidak" value="Tidak"
                                    {{ old('riwayat_penyakit') == 'Tidak' ? 'checked' : '' }}>
                                <label class="form-check-label" for="riwayat_penyakit_tidak">Tidak</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="riwayat_penyakit"
                                    id="riwayat_penyakit_ya" value="Ya"
                                    {{ old('riwayat_penyakit') == 'Ya' ? 'checked' : '' }}>
                                <label class="form-check-label" for="riwayat_penyakit_ya">Ya</label>
                            </div>
                            @error('riwayat_penyakit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3" id="riwayat_penyakit_detail" style="display: none;">
                        <label for="keterangan_riwayat_penyakit" class="col-sm-3 col-form-label">Keterangan riwayat
                            penyakit</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="keterangan_riwayat_penyakit" name="keterangan_riwayat_penyakit">{{ old('keterangan_riwayat_penyakit') }}</textarea>
                            @error('keterangan_riwayat_penyakit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Apakah anak memiliki alergi?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alergi" id="alergi_tidak"
                                    value="Tidak" {{ old('alergi') == 'Tidak' ? 'checked' : '' }}>
                                <label class="form-check-label" for="alergi_tidak">Tidak</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alergi" id="alergi_ya"
                                    value="Ya" {{ old('alergi') == 'Ya' ? 'checked' : '' }}>
                                <label class="form-check-label" for="alergi_ya">Ya</label>
                            </div>
                            @error('alergi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3" id="alergi_detail" style="display: none;">
                        <label for="keterangan_alergi" class="col-sm-3 col-form-label">Keterangan alergi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="keterangan_alergi" name="keterangan_alergi">{{ old('keterangan_alergi') }}</textarea>
                            @error('keterangan_alergi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Apakah rumah bebas asap rokok?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bebas_asap_rokok"
                                    id="bebas_asap_rokok_tidak" value="Tidak"
                                    {{ old('bebas_asap_rokok') == 'Tidak' ? 'checked' : '' }}>
                                <label class="form-check-label" for="bebas_asap_rokok_tidak">Tidak</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bebas_asap_rokok"
                                    id="bebas_asap_rokok_ya" value="Ya"
                                    {{ old('bebas_asap_rokok') == 'Ya' ? 'checked' : '' }}>
                                <label class="form-check-label" for="bebas_asap_rokok_ya">Ya</label>
                            </div>
                            @error('bebas_asap_rokok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Apakah terdapat sumber air bersih?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sumber_air_bersih"
                                    id="sumber_air_bersih_tidak" value="Tidak Tersedia"
                                    {{ old('sumber_air_bersih') == 'Tidak Tersedia' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sumber_air_bersih_tidak">Tidak Tersedia</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sumber_air_bersih"
                                    id="sumber_air_bersih_ya" value="Tersedia"
                                    {{ old('sumber_air_bersih') == 'Tersedia' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sumber_air_bersih_ya">Tersedia</label>
                            </div>
                            @error('sumber_air_bersih')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="button" class="btn btn-info" id="prev-step" disabled>Previous</button>
                        <button type="button" class="btn btn-primary" id="next-step">Next</button>
                        <button type="submit" class="btn btn-success d-none" id="submit-form">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


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
                                "{{ route('petugas-posyandu.data-balita') }}";
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

@endsection
