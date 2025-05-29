@extends('layouts.petugas_puskesmas')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas-puskesmas.daftar-balita') }}">Daftar Balita</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $posyandu->nama_posyandu }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="card-title">Daftar Balita - {{ $posyandu->nama_posyandu }}</div>
            <div>
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
                <select class="form-select form-select-sm w-auto" id="showEntries">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="ms-2">entries</span>
            </div>

            <!-- Search Input -->
            <div class="input-group w-25">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari...">
                <button class="btn btn-info" type="button" id="searchButton">
                    <i class="fas fa-search"></i>
                </button>
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
                @forelse ($posyandu->balita as $index => $balita)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $balita->nama_balita }}</td>
                        <td>{{ $balita->tempat_lahir }}, {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                        <td>{{ $balita->jenis_kelamin }}</td>
                        <td>{{ $balita->orangTua->nama_ayah ?? '-' }} / {{ $balita->orangTua->nama_ibu ?? '-' }}</td>
                        <td>{{ $balita->alamat }}</td>
                        <td>
                                    <a href="{{ route('petugas-puskesmas.daftar-balita.detail', $balita->id) }}"
                                        class="btn btn-sm btn-primary" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data balita.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            Menampilkan <span id="startEntry">1</span> sampai <span id="endEntry">{{ $posyandu->balita->count() }}</span> dari 
            <span id="totalEntries">{{ $posyandu->balita->count() }}</span> data
        </div>

        <!-- Pagination Dummy -->
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
            <div class="modal-body">
                <!-- Form Filter -->
                <form>
                    <div class="mb-3">
                        <label for="filterJenisKelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="filterJenisKelamin">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-primary">FILTER</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
