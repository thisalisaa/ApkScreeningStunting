@extends('layouts.petugas_posyandu')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Data Pengukuran</li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/button-custom.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Data Pengukuran</div>
                <div class="d-flex align-items-center">
                    <button class="btn btn btn-success me-2" title="Import" data-bs-toggle="modal"
                        data-bs-target="#importModal">
                        <i class="fas fa-file-excel"></i> IMPORT
                    </button>
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
                    <form action="{{ route('petugas-posyandu.data-pengukuran') }}" method="GET" class="d-flex w-100">
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
                        <th style="width: 10%;">Usia (bulan)</th>
                        <th style="width: 10%;">Tanggal Pengukuran</th>
                        <th style="width: 5%;">BB (kg)</th>
                        <th style="width: 5%;">TB (cm)</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_balitas as $index => $item)
                        <tr>
                            <td>{{ $balitas->firstItem() + $index }}</td>
                            <td>{{ $item['balita']->nama_balita }}</td>
                            <td>{{ $item['umur'] }}</td>

                            <td>
                                @if ($item['pengukuran'])
                                    {{ \Carbon\Carbon::parse($item['pengukuran']->tanggal_pengukuran)->format('d-m-Y') }}
                                @else
                                    Belum ada pengukuran
                                @endif
                            </td>
                            <td>
                                {{ $item['pengukuran'] && $item['pengukuran']->berat_badan !== null
                                    ? rtrim(rtrim(number_format($item['pengukuran']->berat_badan, 2, '.', ''), '0'), '.')
                                    : '-' }}
                            </td>
                            <td>
                                {{ $item['pengukuran'] && $item['pengukuran']->tinggi_badan !== null
                                    ? rtrim(rtrim(number_format($item['pengukuran']->tinggi_badan, 2, '.', ''), '0'), '.')
                                    : '-' }}
                            </td>

                            <td>
                                        @if ($item['status_verifikasi'])
                                            @switch($item['status_verifikasi'])
                                                @case('to review')
                                                    <a href="{{ route('petugas-posyandu.data-pengukuran.show', $item['pengukuran']->id) }}?bulan={{ $bulan }}&tahun={{ $tahun }}"
                                                        class="btn-custom-orange" title="Status">
                                                        To Review
                                                    </a>
                                                @break

                                                @case('verified')
                                                    <a href="{{ route('petugas-posyandu.data-pengukuran.show', $item['pengukuran']->id) }}?bulan={{ $bulan }}&tahun={{ $tahun }}"
                                                        class="btn-custom-green" title="Status">
                                                        Verified
                                                    </a>
                                                @break

                                                @case('rejected')
                                                    <a href="{{ route('petugas-posyandu.data-pengukuran.show', $item['pengukuran']->id) }}?bulan={{ $bulan }}&tahun={{ $tahun }}"
                                                        class="btn-custom-red" title="Status">
                                                        Rejected
                                                    </a>
                                                @break
                                            @endswitch
                                        @else
                                            <button class="btn-custom-yellow" title="Status">Not Started</button>
                                        @endif
                            </td>

                            <td>
                                <div class="d-flex gap-2">
                                    @if (!$item['pengukuran'])
                                        <!-- Jika tidak ada data pengukuran) -->
                                        <a href="{{ route('petugas-posyandu.data-pengukuran.create', ['id_balita' => $item['balita']->id]) }}?bulan={{ $bulan }}&tahun={{ $tahun }}"
                                            class="btn btn-sm btn-info" title="Tambah">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    @else
                                    <!-- Jika ada data pengukuran -->
                                        <a href="{{ route('petugas-posyandu.data-pengukuran.edit', $item['pengukuran']->id) }}?bulan={{ $bulan }}&tahun={{ $tahun }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit text-white"></i>
                                        </a>

                                        <form
                                            action="{{ route('petugas-posyandu.data-pengukuran.destroy', $item['pengukuran']->id) }}"
                                            method="POST" class="d-inline form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-hapus"
                                                data-nama="{{ $item['balita']->nama_balita }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                Showing {{ $balitas->firstItem() ?? 0 }} to {{ $balitas->lastItem() ?? 0 }} of {{ $balitas->total() }}
                entries
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end">
                    <li class="page-item {{ $balitas->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $balitas->previousPageUrl() ?? '#' }}" tabindex="-1"
                            aria-disabled="{{ $balitas->onFirstPage() ? 'true' : 'false' }}">
                            Previous
                        </a>
                    </li>
                    @foreach ($balitas->getUrlRange(1, $balitas->lastPage()) as $page => $url)
                        <li class="page-item {{ $balitas->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item {{ !$balitas->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $balitas->nextPageUrl() ?? '#' }}"
                            aria-disabled="{{ !$balitas->hasMorePages() ? 'true' : 'false' }}">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


    <!-- Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Pengukuran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('petugas-posyandu.data-pengukuran.import-excel') }}" method="POST"
                    enctype="multipart/form-data" id="add-form">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="fileImport" class="form-label">Pilih File Excel</label>
                            <input type="file" class="form-control" name="file" id="fileImport" required>
                            <input type="hidden" name="bulan" value="{{ $bulan }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                            <small class="form-text text-muted">Format file: .xlsx, .xls</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('petugas-posyandu.data-pengukuran.download-file', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                            class="btn btn-primary">
                            <i class="fas fa-download"></i> EXAMPLE
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-upload"></i> IMPORT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                </div>
                <form action="{{ route('petugas-posyandu.data-pengukuran') }}" method="GET">
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hapusButtons = document.querySelectorAll('.btn-hapus');

            hapusButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('.form-hapus');
                    const nama = this.getAttribute('data-nama');

                    Swal.fire({
                        title: `Hapus data balita?`,
                        text: `Data Pengukuran atas nama "${nama}" akan dihapus secara permanen.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
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
                        if (response.message && response.message.toLowerCase().includes(
                                'import berhasil')) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: response.message,
                                icon: "success"
                            }).then(function() {
                                window.location.href =
                                    "{{ route('petugas-posyandu.data-pengukuran') }}";
                            });
                        } else {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Proses Import Berhasil.",
                                icon: "success"
                            }).then(function() {
                                window.location.href =
                                    "{{ route('petugas-posyandu.data-pengukuran') }}";
                            });
                        }
                    },
                    error: function(xhr, status, error) {
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
