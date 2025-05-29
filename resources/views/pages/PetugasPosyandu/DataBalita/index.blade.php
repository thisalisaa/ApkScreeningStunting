@extends('layouts.petugas_posyandu')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Data Balita</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Data Balita</div>
                <div>
                    <button class="btn btn btn-primary" title="Filter" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter"></i> FILTER
                    </button>
                    <a href="{{ route('petugas-posyandu.data-balita.create') }}" class="btn btn-info">
                        <i class="fas fa-plus"></i> TAMBAH
                    </a>

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <!-- Dropdown Show Entries -->
                <div class="d-flex align-items-center">
                    <label for="showEntries" class="me-2">Show</label>
                    <select class="form-select form-select-sm w-auto" id="showEntries">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="ms-2">entries</span>
                </div>

                <!-- Search Input -->
                <div class="input-group w-25">
                    <form action="{{ route('petugas-posyandu.data-balita') }}" method="GET" class="d-flex w-100">
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
                        <th>Nama</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Orang Tua</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($balitas as $index => $balita)
                        <tr>
                            <td>{{ $balitas->firstItem() + $index }}</td>
                            <td>{{ $balita->nama_balita }}</td>
                            <td>{{ $balita->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                            <td>{{ ucfirst($balita->jenis_kelamin) }}</td>
                            <td>{{ $balita->orangTua->nama_ayah ?? '-' }} / {{ $balita->orangTua->nama_ibu ?? '-' }}</td>
                            <td>{{ Str::limit($balita->alamat, 20) }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('petugas-posyandu.data-balita.show', $balita->id) }}"
                                        class="btn btn-primary btn-sm" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('petugas-posyandu.data-balita.edit', $balita->id) }}"
                                        class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit text-white"></i>
                                    </a>
                                    <form action="{{ route('petugas-posyandu.data-balita.destroy', $balita->id) }}"
                                        method="POST" class="d-inline form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger btn-hapus"
                                            data-nama="{{ $balita->nama_balita }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data balita</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                Showing {{ $balitas->firstItem() ?? 0 }} to {{ $balitas->lastItem() ?? 0 }} of {{ $balitas->total() }} entries
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


    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                </div>
                <div class="modal-body">
                    <form method="GET" action="{{ route('petugas-posyandu.data-balita') }}">
                        <div class="mb-3">
                            <label for="filterJenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="filterJenisKelamin" name="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-primary">FILTER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hapusButtons = document.querySelectorAll('.btn-hapus');

            hapusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.form-hapus');
                    const nama = this.getAttribute('data-nama');

                    Swal.fire({
                        title: `Hapus data balita?`,
                        text: `Data balita atas nama "${nama}" akan dihapus secara permanen.`,
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showEntriesSelect = document.getElementById('showEntries');

            showEntriesSelect.addEventListener('change', function() {
                const selectedValue = showEntriesSelect.value;

                const url = new URL(window.location.href);
                url.searchParams.set('per_page', selectedValue);
                window.location.href = url.toString();
            });
        });
    </script>
@endpush
