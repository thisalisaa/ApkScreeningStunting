@extends('layouts.petugas_puskesmas')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas-puskesmas.daftar-balita') }}">Daftar Balita</a></li>
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
                                <td>{{ $balita->nama_balita }}</td>
                            </tr>
                            <tr>
                                <td><strong>NIK</strong></td>
                                <td>{{ $balita->nik_balita }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tempat Lahir</strong></td>
                                <td>{{ $balita->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lahir</strong></td>
                                <td>{{ \Carbon\Carbon::parse($balita->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>{{ $balita->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td><strong>Berat Badan Lahir</strong></td>
                                <td>{{ $balita->berat_badan_lahir }} kg</td>
                            </tr>
                            <tr>
                                <td><strong>Panjang Badan Lahir</strong></td>
                                <td>{{ $balita->panjang_badan_lahir }} cm</td>
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
                                <td>{{ $balita->orangTua->nama_ayah ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Ibu</strong></td>
                                <td>{{ $balita->orangTua->nama_ibu ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>No. Telepon</strong></td>
                                <td>{{ $balita->orangTua->no_telepon ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Pekerjaan Ayah</strong></td>
                                <td>{{ $balita->orangTua->pekerjaan_ayah ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Pekerjaan Ibu</strong></td>
                                <td>{{ $balita->orangTua->pekerjaan_ibu ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Pendidikan Ayah</strong></td>
                                <td>{{ $balita->orangTua->pendidikan_ayah ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Pendidikan Ibu</strong></td>
                                <td>{{ $balita->orangTua->pendidikan_ibu ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tinggi Badan Ayah</strong></td>
                                <td>{{ $balita->orangTua->tinggi_badan_ayah ?? '-' }} cm</td>
                            </tr>
                            <tr>
                                <td><strong>Tinggi Badan Ibu</strong></td>
                                <td>{{ $balita->orangTua->tinggi_badan_ibu ?? '-' }} cm</td>
                            </tr>
                            <tr>
                                <td><strong>Pendapatan Keluarga</strong></td>
                                <td>{{ $balita->orangTua->pendapatan_keluarga }}</td>

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
                                <td>{{ $balita->dataKesehatan->riwayat_penyakit ?? 'Tidak' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alergi</strong></td>
                                <td>{{ $balita->dataKesehatan->alergi ?? 'Tidak' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Keterangan Alergi</strong></td>
                                <td>{{ $balita->dataKesehatan->keterangan_alergi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Akses Layanan Kesehatan</strong></td>
                                <td>{{ $balita->dataKesehatan->akses_layanan_kesehatan ?? 'Tidak' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Rumah Bebas Asap Rokok</strong></td>
                                <td>{{ $balita->dataKesehatan->rumah_bebas_asap_rokok ?? 'Tidak' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sumber Air Bersih</strong></td>
                                <td>{{ $balita->dataKesehatan->sumber_air_bersih ?? 'Tidak' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
