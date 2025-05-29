@extends('layouts.petugas_puskesmas')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Laporan Pengukuran</li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/button-custom.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Laporan Pengukuran</div>
                <div class="d-flex align-items-center">
                    <button class="btn btn btn-primary" title="Filter" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter"></i> FILTER
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Show Entries dan Search Input -->
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <!-- Dropdown Show Entries -->
                <div class="d-flex align-items-center">
                    <label for="showEntries" class="me-2">Show</label>
                    <form method="GET" id="perPageForm">
                        <select class="form-select form-select-sm w-auto" id="showEntries" name="per_page"
                            onchange="this.form.submit()">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>

                        <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                        <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                    </form>

                    <span class="ms-2">entries</span>
                </div>

                <!-- Search Input -->
                <div class="input-group w-25">
                    <form action="{{ route('petugas-puskesmas.laporan-pengukuran') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari...">
                        <button class="btn btn-info" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Posyandu</th>
                        <th>Desa</th>
                        <th>Jumlah Balita</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posyandus as $index => $posyandu)
                        <tr>
                            <td>{{ $posyandus->firstItem() + $index }}</td>
                            <td>{{ $posyandu->nama_posyandu }}</td>
                            <td>{{ $posyandu->desa->name ?? '-' }}</td>
                            <td>{{ $posyandu->balita_count }}</td>
                            <td>
                                @php
                                    $status = $posyandu->latest_status;
                                @endphp

                                @if ($status)
                                    @switch($status->status_verifikasi)
                                        @case('to review')
                                            <a href="{{ route('petugas-puskesmas.laporan-pengukuran.show', [
                                                'bulan' => request('bulan'),
                                                'tahun' => request('tahun'),
                                                'posyandu_id' => $posyandu->id,
                                            ]) }}"
                                                class="btn-custom-orange" title="Status">
                                                To Review
                                            </a>
                                        @break

                                        @case('verified')
                                            <a href="{{ route('petugas-puskesmas.laporan-pengukuran.show', [
                                                'bulan' => request('bulan'),
                                                'tahun' => request('tahun'),
                                                'posyandu_id' => $posyandu->id,
                                            ]) }}"
                                                class="btn-custom-green" title="Status">
                                                Verified
                                            </a>
                                        @break

                                        @case('rejected')
                                            <a href="{{ route('petugas-puskesmas.laporan-pengukuran.show', [
                                                'bulan' => request('bulan'),
                                                'tahun' => request('tahun'),
                                                'posyandu_id' => $posyandu->id,
                                            ]) }}"
                                                class="btn-custom-red" title="Status">
                                                Rejected
                                            </a>
                                        @break
                                    @endswitch
                                @else
                                    <button class="btn-custom-yellow" title="Status">Not Started</button>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No data available in table</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    Showing {{ $posyandus->firstItem() ?? 0 }} to {{ $posyandus->lastItem() ?? 0 }} of
                    {{ $posyandus->total() }} entries
                </div>


                <!-- Pagination Custom -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link text-primary" href="#">1</a></li>
                        <li class="page-item"><a class="page-link text-primary" href="#">2</a></li>
                        <li class="page-item"><a class="page-link text-primary" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link text-primary" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
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
                    <form action="{{ route('petugas-puskesmas.laporan-pengukuran') }}" method="GET">
                        <div class="modal-body">
                            <!-- Dropdown Bulan -->
                            <div class="mb-3">
                                <label for="filterBulan" class="form-label">Bulan</label>
                                <select class="form-select" id="filterBulan" name="bulan">
                                    <option value="">Pilih Bulan</option>
                                    <option value="1" {{ $bulan == '1' ? 'selected' : '' }}>Januari</option>
                                    <option value="2" {{ $bulan == '2' ? 'selected' : '' }}>Februari</option>
                                    <option value="3" {{ $bulan == '3' ? 'selected' : '' }}>Maret</option>
                                    <option value="4" {{ $bulan == '4' ? 'selected' : '' }}>April</option>
                                    <option value="5" {{ $bulan == '5' ? 'selected' : '' }}>Mei</option>
                                    <option value="6" {{ $bulan == '6' ? 'selected' : '' }}>Juni</option>
                                    <option value="7" {{ $bulan == '7' ? 'selected' : '' }}>Juli</option>
                                    <option value="8" {{ $bulan == '8' ? 'selected' : '' }}>Agustus</option>
                                    <option value="9" {{ $bulan == '9' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ $bulan == '10' ? 'selected' : '' }}>Oktober</option>
                                    <option value="11" {{ $bulan == '11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ $bulan == '12' ? 'selected' : '' }}>Desember</option>
                                </select>
                            </div>
                            <!-- Input Tahun -->
                            <div class="mb-3">
                                <label for="filterTahun" class="form-label">Tahun</label>
                                <select class="form-select" name="tahun" id="tahun">
                                    @for ($i = 2015; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}" {{ $i == $tahun ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>

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
