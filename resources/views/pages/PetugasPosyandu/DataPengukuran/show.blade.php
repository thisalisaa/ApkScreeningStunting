@extends('layouts.petugas_posyandu')

@section('title', 'Detail Pengukuran')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas-posyandu.data-pengukuran') }}">Data Pengukuran</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Pengukuran</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card card-round">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('image/child.png') }}" alt="Foto Balita" class="rounded-circle me-3"
                            style="width: 60px; height: 60px;">
                        <div>
                            <h4 class="mb-0">{{ $pengukuran->balita->nama_balita }}</h4>
                            <small><strong>Umur :</strong>{{ $pengukuran->usia_bulan }} bulan</small><br>
                            <small><strong>Tanggal Pengukuran :</strong>
                                {{ \Carbon\Carbon::parse($pengukuran->tanggal_pengukuran)->format('d M Y') }}</small>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mt-3 fw-bold">Data Pengukuran</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered bg-light">
                            <tbody>
                                <tr>
                                    <th class="w-50">Tinggi Badan</th>
                                    <td>{{ rtrim(rtrim(number_format($pengukuran->tinggi_badan, 2, '.', ''), '0'), '.') }}
                                        cm</td>
                                </tr>
                                <tr>
                                    <th>Berat Badan</th>
                                    <td>{{ rtrim(rtrim(number_format($pengukuran->berat_badan, 2, '.', ''), '0'), '.') }} kg
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pemberian ASI</th>
                                    <td>{{ $pengukuran->asi_ekslusif == 1 ? 'ASI diberikan' : 'ASI tidak diberikan' }}</td>
                                </tr>
                                <tr>
                                    <th>Pemberian MPASI</th>
                                    <td>{{ $pengukuran->mpasi == 1 ? 'MPASI baik' : 'MPASI tidak baik' }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <h5 class="mt-4 fw-bold">Data Antropometri</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered bg-light">
                            <tbody>
                                <tr>
                                    <th class="w-50">Z-Score BB/U</th>
                                    <td>{{ rtrim(rtrim(sprintf('%.2f', $pengukuran->dataAntropometri->z_score_bb_u), '0'), '.') }}
                                        SD</td>
                                </tr>
                                <tr>
                                    <th>Z-Score TB/U</th>
                                    <td>{{ rtrim(rtrim(sprintf('%.2f', $pengukuran->dataAntropometri->z_score_tb_u), '0'), '.') }}
                                        SD</td>
                                </tr>
                                <tr>
                                    <th>Z-Score BB/TB</th>
                                    <td>{{ rtrim(rtrim(sprintf('%.2f', $pengukuran->dataAntropometri->z_score_bb_tb), '0'), '.') }}
                                        SD</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h5 class="mt-4 fw-bold">Data Gizi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered bg-light">
                            <tbody>
                                <tr>
                                    <th class="w-50">Berat Badan/Umur</th>
                                    <td>{{ $pengukuran->dataAntropometri->hasilScreening->status_bb_u ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tinggi Badan/Umur</th>
                                    <td>{{ $pengukuran->dataAntropometri->hasilScreening->status_tb_u ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Berat Badan/Tinggi Badan</th>
                                    <td>{{ $pengukuran->dataAntropometri->hasilScreening->status_bb_tb ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status Gizi</th>
                                    <td>{{ $pengukuran->dataAntropometri->hasilScreening->status_stunting ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Persentase Risiko Stunting</th>
                                    <td>{{ $pengukuran->dataAntropometri->hasilScreening->presentase_resiko_stunting ?? '-' }}%
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-3">
                        <p class="text-center">Diverifikasi oleh,</p>
                        <p class="text-center text-success">
                            @if ($pengukuran->status_verifikasi == 'verified')
                                <i class="fa fa-check-circle fa-4x"></i>
                            @elseif ($pengukuran->status_verifikasi == 'rejected')
                                <i class="fa fa-times-circle fa-4x" style="color: red;"></i>
                            @else
                            @endif
                        </p>

                        <p class="text-center">
                            @if (in_array($pengukuran->status_verifikasi, ['verified', 'rejected']))
                                {{ $pengukuran->user->nama ?? '-' }}<br>
                                {{ $pengukuran->verified_at ? \Carbon\Carbon::parse($pengukuran->verified_at)->format('Y-m-d H:i:s') : '-' }}
                                <br>
                                Catatan : {{ $pengukuran->catatan ?? '( - )' }}<br>
                            @else
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
