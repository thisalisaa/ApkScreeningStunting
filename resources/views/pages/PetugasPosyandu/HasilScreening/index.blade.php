@extends('layouts.petugas_posyandu')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Hasil Screening</li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/button.css') }}">
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Hasil Screening</div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-danger me-2 text-white" title="Export">
                        <i class="fas fa-file-pdf"></i> DOWNLOAD
                    </button>
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
                    <form action="{{ route('petugas-posyandu.hasil-screening') }}" method="GET" class="d-flex w-100">
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
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Nama Balita</th>
                        <th style="width: 25%;">Berat Badan/Umur</th>
                        <th style="width: 25%;">Tinggi Badan/Umur</th>
                        <th style="width: 25%;">Berat Badan/Tinggi Badan</th>
                        <th style="width: 25%;">Status Gizi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hasilScreenings as $index => $hasil)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $hasil->dataAntropometri->dataPengukuran->balita->nama_balita ?? '-' }}</td>
                            {{-- STATUS BB/U --}}
                            <td>
                                @if ($hasil->status_bb_u == 'sangat kurang')
                                    <span class="btn-custom-red">Sangat Kurang</span>
                                @elseif ($hasil->status_bb_u == 'kurang')
                                    <span class="btn-custom-orange">Kurang</span>
                                @elseif ($hasil->status_bb_u == 'normal')
                                    <span class="btn-custom-green">Normal</span>
                                @else
                                    <span class="btn-custom-yellow">Berat Lebih</span>
                                @endif
                            </td>

                            {{-- STATUS TB/U --}}
                            <td>
                                @if ($hasil->status_tb_u == 'sangat pendek')
                                    <span class="btn-custom-red">Sangat Pendek</span>
                                @elseif ($hasil->status_tb_u == 'pendek')
                                    <span class="btn-custom-orange">Pendek</span>
                                @elseif ($hasil->status_tb_u == 'normal')
                                    <span class="btn-custom-green">Normal</span>
                                @else
                                    <span class="btn-custom-yellow">Tinggi</span>
                                @endif
                            </td>

                            {{-- STATUS BB/TB --}}
                            <td>
                                @if ($hasil->status_bb_tb == 'gizi buruk')
                                    <span class="btn-custom-red">Gizi Buruk</span>
                                @elseif ($hasil->status_bb_tb == 'gizi kurang')
                                    <span class="btn-custom-orange">Gizi Kurang</span>
                                @elseif ($hasil->status_bb_tb == 'gizi baik')
                                    <span class="btn-custom-green">Gizi Baik</span>
                                @elseif ($hasil->status_bb_tb == 'berisiko gizi lebih')
                                    <span class="btn-custom-yellow">Risiko Gizi Lebih</span>
                                @elseif ($hasil->status_bb_tb == 'gizi lebih')
                                    <span class="btn-custom-yellow">Gizi Lebih</span>
                                @else
                                    <span class="btn-custom-red">Obesitas</span>
                                @endif
                            </td>

                            {{-- STATUS STUNTING --}}
                            <td>
                                @if ($hasil->status_stunting == 'stunting')
                                    <span class="btn-custom-red">Stunting</span>
                                @elseif ($hasil->status_stunting == 'beresiko')
                                    <span class="btn-custom-orange">Beresiko</span>
                                @else
                                    <span class="btn-custom-green">Normal</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No data available in table.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            <div>
                Showing {{ $hasilScreenings->firstItem() ?? 0 }} to {{ $hasilScreenings->lastItem() ?? 0 }} of
                {{ $hasilScreenings->total() }} entries
            </div>

        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                <li class="page-item {{ $hasilScreenings->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $hasilScreenings->previousPageUrl() ?? '#' }}" tabindex="-1"
                        aria-disabled="{{ $hasilScreenings->onFirstPage() ? 'true' : 'false' }}">
                        Previous
                    </a>
                </li>
                @foreach ($hasilScreenings->getUrlRange(1, $hasilScreenings->lastPage()) as $page => $url)
                    <li class="page-item {{ $hasilScreenings->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ !$hasilScreenings->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $hasilScreenings->nextPageUrl() ?? '#' }}"
                        aria-disabled="{{ !$hasilScreenings->hasMorePages() ? 'true' : 'false' }}">
                        Next
                    </a>
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
                </div>
                <form action="{{ route('petugas-posyandu.hasil-screening') }}" method="GET">
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
