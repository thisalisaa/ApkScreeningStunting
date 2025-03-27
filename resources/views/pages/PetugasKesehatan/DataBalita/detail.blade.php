@extends('layouts.petugas_kesehatan')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.databalita') }}">Data Balita</a></li>
    <li class="breadcrumb-item active" aria-current="page">Biodata Balita</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold mb-0">Biodata Balita</h5>
            <button class="btn btn-danger me-2 text-white" title="Export">
                <i class="fas fa-file-pdf"></i> DOWNLOAD
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Foto Balita -->
            <div class="col-md-3 text-center">
                <img src="{{ asset('image/user.png') }}" alt="Foto Balita" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
            </div>

            <!-- Data Informasi -->
            <div class="col-md-9">
                <!-- Data Balita -->
                <div class="mb-4">
                    <h4 class="fw-bold">Data Balita</h4>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td><strong>Nama Balita</strong></td>
                                <td>Budi Santoso</td>
                            </tr>
                            <tr>
                                <td><strong>NIK</strong></td>
                                <td>1234567890123456</td>
                            </tr>
                            <tr>
                                <td><strong>Tempat Lahir</strong></td>
                                <td>Jakarta</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lahir</strong></td>
                                <td>15 Januari 2020</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>Laki-laki</td>
                            </tr>
                            <tr>
                                <td><strong>Berat Badan Lahir</strong></td>
                                <td>3.2 kg</td>
                            </tr>
                            <tr>
                                <td><strong>Panjang Badan Lahir</strong></td>
                                <td>50 cm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Data Orang Tua -->
                <div class="mb-4">
                    <h4 class="fw-bold">Data Orang Tua</h4>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td><strong>Nama Ayah</strong></td>
                                <td>Ahmad Santoso</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Ibu</strong></td>
                                <td>Siti Rahayu</td>
                            </tr>
                            <tr>
                                <td><strong>No. Telepon</strong></td>
                                <td>081234567890</td>
                            </tr>
                            <tr>
                                <td><strong>Pekerjaan Ayah</strong></td>
                                <td>Wiraswasta</td>
                            </tr>
                            <tr>
                                <td><strong>Pekerjaan Ibu</strong></td>
                                <td>Ibu Rumah Tangga</td>
                            </tr>
                            <tr>
                                <td><strong>Pendidikan Ayah</strong></td>
                                <td>SMA</td>
                            </tr>
                            <tr>
                                <td><strong>Pendidikan Ibu</strong></td>
                                <td>SMP</td>
                            </tr>
                            <tr>
                                <td><strong>Tinggi Badan Ayah</strong></td>
                                <td>170 cm</td>
                            </tr>
                            <tr>
                                <td><strong>Tinggi Badan Ibu</strong></td>
                                <td>160 cm</td>
                            </tr>
                            <tr>
                                <td><strong>Pendapatan</strong></td>
                                <td>Rp 5.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Data Kesehatan -->
                <div class="mb-4">
                    <h4 class="fw-bold">Data Kesehatan</h4>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td><strong>Riwayat Penyakit</strong></td>
                                <td>Tidak</td>
                            </tr>
                            <tr>
                                <td><strong>Alergi</strong></td>
                                <td>Ya</td>
                            </tr>
                            <tr>
                                <td><strong>Keterangan Alergi</strong></td>
                                <td>Alergi debu dan susu sapi</td>
                            </tr>
                            <tr>
                                <td><strong>Akses Layanan Kesehatan</strong></td>
                                <td>Ya</td>
                            </tr>
                            <tr>
                                <td><strong>Rumah Bebas Asap Rokok</strong></td>
                                <td>Ya</td>
                            </tr>
                            <tr>
                                <td><strong>Sumber Air Bersih</strong></td>
                                <td>Ya</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection