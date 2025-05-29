@extends('layouts.petugas_posyandu')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas-posyandu.data-balita') }}">Data Balita</a></li>
    <li class="breadcrumb-item active" aria-current="page">Biodata Balita</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold mb-0">Biodata - {{ $balita->nama_balita }}</h5>
                <a href="{{ route('petugas-posyandu.data-balita.export-pdf', $balita->id) }}"
                    class="btn btn-danger me-2 text-white" title="Export" target="_blank">
                    <i class="fas fa-file-pdf"></i> DOWNLOAD
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="{{ asset('image/user.png') }}" alt="Foto Balita" class="img-fluid rounded-circle mb-3"
                        style="width: 150px; height: 150px; object-fit: cover;">
                </div>

                <div class="col-md-9">
                    <div class="mb-4">
                        <h4 class="fw-bold">Data Balita</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="30%"><strong>Nama Balita</strong></td>
                                    <td>{{ $balita->nama_balita }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NIK</strong></td>
                                    <td>{{ $balita->nik_balita }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat, Tanggal Lahir</strong></td>
                                    <td>{{ $balita->tempat_lahir }} ,
                                        {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin</strong></td>
                                    <td>{{ ucfirst($balita->jenis_kelamin) }}</td>

                                </tr>
                                <tr>
                                    <td><strong>Berat Badan Lahir</strong></td>
                                    <td>{{ rtrim(rtrim($balita->berat_badan_lahir, '0'), '.') }} kg</td>
                                </tr>
                                <tr>
                                    <td><strong>Panjang Badan Lahir</strong></td>
                                    <td>{{ rtrim(rtrim($balita->panjang_badan_lahir, '0'), '.') }} cm</td>

                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>{{ $balita->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-4">
                        <h4 class="fw-bold">Data Orang Tua</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="30%"><strong>Nama Ayah</strong></td>
                                    <td>{{ $balita->orangTua->nama_ayah }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Ibu</strong></td>
                                    <td>{{ $balita->orangTua->nama_ibu }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. Telepon</strong></td>
                                    <td>{{ $balita->orangTua->no_telepon }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pekerjaan Ayah</strong></td>
                                    <td>{{ $balita->orangTua->pekerjaan_ayah }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pekerjaan Ibu</strong></td>
                                    <td>{{ $balita->orangTua->pekerjaan_ibu }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pendidikan Ayah</strong></td>
                                    <td>{{ $balita->orangTua->pendidikan_ayah }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pendidikan Ibu</strong></td>
                                    <td>{{ $balita->orangTua->pendidikan_ibu }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tinggi Badan Ayah</strong></td>
                                    <td>{{ $balita->orangTua->tinggi_badan_ayah }} cm</td>
                                </tr>
                                <tr>
                                    <td><strong>Tinggi Badan Ibu</strong></td>
                                    <td>{{ $balita->orangTua->tinggi_badan_ibu }} cm</td>
                                </tr>
                                <tr>
                                    <td><strong>Pendapatan Keluarga</strong></td>
                                    <td>{{ $balita->orangTua->pendapatan_keluarga }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-4">
                        <h4 class="fw-bold">Data Kesehatan</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="30%"><strong>Riwayat Penyakit</strong></td>
                                    <td>{{ $balita->dataKesehatan->riwayat_penyakit }}</td>
                                </tr>
                                @if ($balita->dataKesehatan->riwayat_penyakit == 'Ya')
                                    <tr>
                                        <td><strong>Keterangan Riwayat Penyakit</strong></td>
                                        <td>{{ $balita->dataKesehatan->keterangan_riwayat_penyakit }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td><strong>Alergi</strong></td>
                                    <td>{{ $balita->dataKesehatan->alergi }}</td>
                                </tr>
                                @if ($balita->dataKesehatan->alergi == 'Ya')
                                    <tr>
                                        <td><strong>Keterangan Alergi</strong></td>
                                        <td>{{ $balita->dataKesehatan->keterangan_alergi }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td><strong>Rumah Bebas Asap Rokok</strong></td>
                                    <td>{{ $balita->dataKesehatan->bebas_asap_rokok }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Sumber Air Bersih</strong></td>
                                    <td>{{ $balita->dataKesehatan->sumber_air_bersih }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
