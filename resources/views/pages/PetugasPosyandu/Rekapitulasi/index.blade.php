@extends('layouts.petugas_posyandu')

@section('title', 'APK-Screening - Rekapitulasi')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Rekapitulasi</li>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">
                    Rekapitulasi Status Gizi
                    <small class="text-muted">
                        ({{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->format('F Y') }})
                    </small>
                </div>
                <div class="d-flex align-items-center">
                    {{-- <a href="{{ route('rekapitulasi.export-pdf') }}?bulan={{ $bulan }}&tahun={{ $tahun }}"
                        class="btn btn-danger me-2 text-white" title="Export PDF">
                        <i class="fas fa-file-pdf"></i> PDF
                    </a>
                    <a href="{{ route('rekapitulasi.export-excel') }}?bulan={{ $bulan }}&tahun={{ $tahun }}"
                        class="btn btn-success me-2" title="Export Excel">
                        <i class="fas fa-file-excel"></i> EXCEL
                    </a> --}}
                    <button class="btn btn-primary" title="Filter" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter"></i> FILTER
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($rekapitulasi['total'] > 0)
                <!-- Table 1: Rekapitulasi Status Gizi -->
                <div class="table-responsive mb-5">
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 30%;">Kategori</th>
                                <th style="width: 20%;">Jumlah Balita</th>
                                <th style="width: 20%;">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Stunting</td>
                                <td>{{ $rekapitulasi['stunting']['jumlah'] }}</td>
                                <td>{{ $rekapitulasi['stunting']['persentase'] }}%</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Normal</td>
                                <td>{{ $rekapitulasi['normal']['jumlah'] }}</td>
                                <td>{{ $rekapitulasi['normal']['persentase'] }}%</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Beresiko</td>
                                <td>{{ $rekapitulasi['beresiko']['jumlah'] }}</td>
                                <td>{{ $rekapitulasi['beresiko']['persentase'] }}%</td>
                            </tr>
                            <tr class="table-secondary fw-bold">
                                <td colspan="2">Total</td>
                                <td>{{ $rekapitulasi['total'] }}</td>
                                <td>100%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table 2: Detail Status Gizi per Indikator -->
                <h5 class="mb-3">Detail Status Gizi per Indikator</h5>
                <div class="table-responsive mb-5">
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th rowspan="2" style="width: 5%;">No</th>
                                <th rowspan="2" style="width: 20%;">Indikator</th>
                                <th colspan="3" style="width: 45%;">Kategori</th>
                                <th rowspan="2" style="width: 15%;">Jumlah Balita</th>
                                <th rowspan="2" style="width: 15%;">Persentase</th>
                            </tr>
                            <tr>
                                <th>Sangat Pendek/Pendek</th>
                                <th>Normal</th>
                                <th>Sangat Kurus/Kurus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>TB/U (Tinggi Badan menurut Umur)</td>
                                <td>{{ $detailPerIndikator['tb_u']['pendek'] }}</td>
                                <td>{{ $detailPerIndikator['tb_u']['normal'] }}</td>
                                <td>-</td>
                                <td>{{ $detailPerIndikator['tb_u']['total'] }}</td>
                                <td>{{ $detailPerIndikator['tb_u']['total'] > 0 ? '100%' : '0%' }}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>BB/U (Berat Badan menurut Umur)</td>
                                <td>-</td>
                                <td>{{ $detailPerIndikator['bb_u']['normal'] }}</td>
                                <td>{{ $detailPerIndikator['bb_u']['kurus'] }}</td>
                                <td>{{ $detailPerIndikator['bb_u']['total'] }}</td>
                                <td>{{ $detailPerIndikator['bb_u']['total'] > 0 ? '100%' : '0%' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table 3: Distribusi Berdasarkan Umur -->
                <h5 class="mb-3">Distribusi Status Gizi Berdasarkan Umur</h5>
                <div class="table-responsive mb-5">
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 25%;">Rentang Umur (bulan)</th>
                                <th style="width: 15%;">Total Balita</th>
                                <th style="width: 15%;">Stunting</th>
                                <th style="width: 15%;">Normal</th>
                                <th style="width: 15%;">Beresiko</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                $totalAll = 0;
                                $totalStunting = 0;
                                $totalNormal = 0;
                                $totalBeresiko = 0;
                            @endphp
                            @foreach ($distribusiUmur as $rentang => $data)
                                @php
                                    $totalAll += $data['total'];
                                    $totalStunting += $data['stunting'];
                                    $totalNormal += $data['normal'];
                                    $totalBeresiko += $data['beresiko'];
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $rentang }}</td>
                                    <td>{{ $data['total'] }}</td>
                                    <td>{{ $data['stunting'] }}</td>
                                    <td>{{ $data['normal'] }}</td>
                                    <td>{{ $data['beresiko'] }}</td>
                                </tr>
                            @endforeach
                            <tr class="table-secondary fw-bold">
                                <td colspan="2">Total</td>
                                <td>{{ $totalAll }}</td>
                                <td>{{ $totalStunting }}</td>
                                <td>{{ $totalNormal }}</td>
                                <td>{{ $totalBeresiko }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table 4: Distribusi Berdasarkan Jenis Kelamin -->
                <h5 class="mb-3">Distribusi Status Gizi Berdasarkan Jenis Kelamin</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 25%;">Jenis Kelamin</th>
                                <th style="width: 15%;">Total Balita</th>
                                <th style="width: 15%;">Stunting</th>
                                <th style="width: 15%;">Normal</th>
                                <th style="width: 15%;">Beresiko</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Laki-laki</td>
                                <td>{{ $distribusiJenisKelamin['laki-laki']['total'] }}</td>
                                <td>{{ $distribusiJenisKelamin['laki-laki']['stunting'] }}</td>
                                <td>{{ $distribusiJenisKelamin['laki-laki']['normal'] }}</td>
                                <td>{{ $distribusiJenisKelamin['laki-laki']['beresiko'] }}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Perempuan</td>
                                <td>{{ $distribusiJenisKelamin['perempuan']['total'] }}</td>
                                <td>{{ $distribusiJenisKelamin['perempuan']['stunting'] }}</td>
                                <td>{{ $distribusiJenisKelamin['perempuan']['normal'] }}</td>
                                <td>{{ $distribusiJenisKelamin['perempuan']['beresiko'] }}</td>
                            </tr>
                            <tr class="table-secondary fw-bold">
                                <td colspan="2">Total</td>
                                <td>{{ $distribusiJenisKelamin['laki-laki']['total'] + $distribusiJenisKelamin['perempuan']['total'] }}
                                </td>
                                <td>{{ $distribusiJenisKelamin['laki-laki']['stunting'] + $distribusiJenisKelamin['perempuan']['stunting'] }}
                                </td>
                                <td>{{ $distribusiJenisKelamin['laki-laki']['normal'] + $distribusiJenisKelamin['perempuan']['normal'] }}
                                </td>
                                <td>{{ $distribusiJenisKelamin['laki-laki']['beresiko'] + $distribusiJenisKelamin['perempuan']['beresiko'] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center">
                    <i class="fas fa-info-circle"></i>
                    Tidak ada data screening untuk periode
                    {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->format('F Y') }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="GET" action="{{ route('petugas-posyandu.rekapitulasi') }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="filterBulan" class="form-label">Bulan</label>
                            <select class="form-select" id="filterBulan" name="bulan">
                                <option value="1" {{ $bulan == 1 ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ $bulan == 2 ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ $bulan == 3 ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ $bulan == 4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{ $bulan == 5 ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ $bulan == 6 ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ $bulan == 7 ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ $bulan == 8 ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ $bulan == 9 ? 'selected' : '' }}>September</option>
                                <option value="10" {{ $bulan == 10 ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ $bulan == 11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{ $bulan == 12 ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="filterTahun" class="form-label">Tahun</label>
                            <input type="number" class="form-control" id="filterTahun" name="tahun" min="2000"
                                max="2099" value="{{ $tahun }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-primary">FILTER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
