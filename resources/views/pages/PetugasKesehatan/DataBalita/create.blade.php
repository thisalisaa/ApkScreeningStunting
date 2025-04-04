@extends('layouts.petugas_kesehatan')

@section('title', 'APK-Screening')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.data-balita') }}">Data Balita</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data Balita</li>
@endsection

@section('content')
 <!-- Stepper -->
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

        <!-- Form -->
        <form action="{{ route('petugas.data-balita.create') }}" method="POST">
            @csrf

            <!-- Step 1: Data Balita -->
            <div class="stepper-step" data-step="1">
                <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Balita</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Balita" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="nik" name="nik" placeholder="NIK" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="" selected disabled>Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="berat_badan_lahir" class="col-sm-3 col-form-label">Berat Badan Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="berat_badan_lahir" name="berat_badan_lahir" placeholder="Berat Badan Lahir" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="panjang_badan_lahir" class="col-sm-3 col-form-label">Panjang Badan Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="panjang_badan_lahir" name="panjang_badan_lahir" placeholder="Panjang Badan Lahir" required>
                    </div>
                </div>
            </div>

            <!-- Step 2: Data Orang Tua -->
            <div class="stepper-step d-none" data-step="2">
                <div class="row mb-3">
                    <label for="nama_ayah" class="col-sm-3 col-form-label">Nama Ayah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" required>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="nama_ibu" class="col-sm-3 col-form-label">Nama Ibu</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" required>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="no_telepon" class="col-sm-3 col-form-label">No. Telepon</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No.Telp" required>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="pekerjaan_ayah" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah" required>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="pekerjaan_ibu" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu" required>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="pendidikan_ayah" class="col-sm-3 col-form-label">Pendidikan Ayah</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="pendidikan_ayah" name="pendidikan_ayah" required>
                            <option value="">Pilih Pendidikan Ayah</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="pendidikan_ibu" class="col-sm-3 col-form-label">Pendidikan Ibu</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="pendidikan_ibu" name="pendidikan_ibu" required>
                            <option value="">Pilih Pendidikan Ibu</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="tinggi_ayah" class="col-sm-3 col-form-label">Tinggi Badan Ayah (cm)</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="tinggi_ayah" name="tinggi_ayah" placeholder="Tinggi Badan Ayah" required>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="tinggi_ibu" class="col-sm-3 col-form-label">Tinggi Badan Ibu (cm)</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="tinggi_ibu" name="tinggi_ibu" placeholder="Tinggi Badan Ibu" required>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="pendapatan" class="col-sm-3 col-form-label">Pendapatan (per bulan)</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="pendapatan" name="pendapatan" placeholder="Pendapatan Perbulan" required>
                    </div>
                </div>
            </div>

            <!-- Step 3: Data Kesehatan -->
            <div class="stepper-step d-none" data-step="3">
    
            
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Pernah mengalami riwayat penyakit?</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="riwayat_penyakit" id="riwayat_penyakit_tidak" value="Tidak" checked>
                            <label class="form-check-label" for="riwayat_penyakit_tidak">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="riwayat_penyakit" id="riwayat_penyakit_ya" value="Ya">
                            <label class="form-check-label" for="riwayat_penyakit_ya">Ya</label>
                        </div>
                    </div>
                </div>
            
                <div class="row mb-3" id="riwayat_penyakit_detail" style="display: none;">
                    <label for="riwayat_penyakit_keterangan" class="col-sm-3 col-form-label">Jelaskan riwayat penyakit</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="riwayat_penyakit_keterangan" name="riwayat_penyakit_keterangan" placeholder="Masukkan riwayat penyakit"></textarea>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Apakah anak memiliki alergi?</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="alergi" id="alergi_tidak" value="Tidak" checked>
                            <label class="form-check-label" for="alergi_tidak">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="alergi" id="alergi_ya" value="Ya">
                            <label class="form-check-label" for="alergi_ya">Ya</label>
                        </div>
                    </div>
                </div>
            
                <div class="row mb-3" id="alergi_detail" style="display: none;">
                    <label for="alergi_keterangan" class="col-sm-3 col-form-label">Jelaskan alergi</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="alergi_keterangan" name="alergi_keterangan" placeholder="Masukkan jenis alergi"></textarea>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Akses layanan kesehatan baik?</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="akses_layanan_kesehatan" id="akses_layanan_kesehatan_tidak" value="Tidak">
                            <label class="form-check-label" for="akses_layanan_kesehatan_tidak">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="akses_layanan_kesehatan" id="akses_layanan_kesehatan_ya" value="Ya" checked>
                            <label class="form-check-label" for="akses_layanan_kesehatan_ya">Ya</label>
                        </div>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Rumah bebas asap rokok?</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bebas_asap_rokok" id="bebas_asap_rokok_tidak" value="Tidak">
                            <label class="form-check-label" for="bebas_asap_rokok_tidak">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bebas_asap_rokok" id="bebas_asap_rokok_ya" value="Ya" checked>
                            <label class="form-check-label" for="bebas_asap_rokok_ya">Ya</label>
                        </div>
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Sumber air bersih?</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sumber_air_bersih" id="sumber_air_bersih_tidak" value="Tidak">
                            <label class="form-check-label" for="sumber_air_bersih_tidak">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sumber_air_bersih" id="sumber_air_bersih_ya" value="Ya" checked>
                            <label class="form-check-label" for="sumber_air_bersih_ya">Ya</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                document.getElementById('riwayat_penyakit_ya').addEventListener('change', function() {
                    document.getElementById('riwayat_penyakit_detail').style.display = this.checked ? 'block' : 'none';
                });
            
                document.getElementById('riwayat_penyakit_tidak').addEventListener('change', function() {
                    document.getElementById('riwayat_penyakit_detail').style.display = 'none';
                });
            
                document.getElementById('alergi_ya').addEventListener('change', function() {
                    document.getElementById('alergi_detail').style.display = this.checked ? 'block' : 'none';
                });
            
                document.getElementById('alergi_tidak').addEventListener('change', function() {
                    document.getElementById('alergi_detail').style.display = 'none';
                });
            </script>

            <!-- Navigation Buttons -->
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

<style>
.stepper {
    position: relative;
    margin-bottom: 2rem;
}

.stepper-progress {
    height: 4px;
    background-color: #e9ecef;
    border-radius: 2px;
    overflow: hidden;
}

.stepper-progress-bar {
    height: 100%;
    background-color: #0d6efd;
    transition: width 0.3s ease;
}

.stepper-nav {
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
}

.stepper-nav-item {
    background: none;
    border: none;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    color: #6c757d;
    cursor: pointer;
    position: relative;
}

.stepper-nav-item.active {
    color: #0d6efd;
    font-weight: bold;
}

.stepper-step {
    display: none;
}

.stepper-step.active {
    display: block;
}
</style>

<!-- Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.stepper-step');
    const prevBtn = document.getElementById('prev-step');
    const nextBtn = document.getElementById('next-step');
    const submitBtn = document.getElementById('submit-form');
    const stepperNavItems = document.querySelectorAll('.stepper-nav-item');
    const stepperProgressBar = document.querySelector('.stepper-progress-bar');

    let currentStep = 1;

    function updateStepper() {
        steps.forEach((step, index) => {
            if (index + 1 === currentStep) {
                step.classList.add('active');
                step.classList.remove('d-none');
            } else {
                step.classList.remove('active');
                step.classList.add('d-none');
            }
        });

        stepperNavItems.forEach((item, index) => {
            if (index + 1 === currentStep) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });

        prevBtn.disabled = currentStep === 1;
        nextBtn.style.display = currentStep === steps.length ? 'none' : 'inline-block';
        submitBtn.style.display = currentStep === steps.length ? 'inline-block' : 'none';

        const progressWidth = (currentStep - 1) / (steps.length - 1) * 100;
        stepperProgressBar.style.width = `${progressWidth}%`;
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep < steps.length) {
            currentStep++;
            updateStepper();
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            updateStepper();
        }
    });

    updateStepper();
});
</script>

@endsection