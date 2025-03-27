@extends('layouts.petugas_kesehatan')

@section('title', 'APK-Screening')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Data Pengukuran</li>

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Data Pengukuran</div>
                <div class="d-flex align-items-center">
                    <button class="btn btn btn-success me-2" title="Import" data-bs-toggle="modal" data-bs-target="#importModal">
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

                <div class="input-group w-25">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari...">
                    <button class="btn btn-info" type="button" id="searchButton">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <table class="table table-striped mt-3" >
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Nama Balita</th>
                        <th style="width: 5%;">Usia (bulan)</th>
                        <th style="width: 10%;">Tanggal Pengukuran</th>
                        <th style="width: 5%;">BB (kg)</th>
                        <th style="width: 5%;">TB (cm)</th>
                        <th style="width: 5%;">LK (cm)</th> 
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Budi Santoso</td>
                        <td>36</td>
                        <td>2023-10-01</td>
                        <td>12.5</td>
                        <td>85</td>
                        <td>48</td> 
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-info" title="Tambah" data-bs-toggle="modal" data-bs-target="#tambahPengukuranModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="#" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit text-white"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-3">
                Showing <span id="startEntry">1</span> to <span id="endEntry">5</span> of <span id="totalEntries">10</span>
                entries
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

    <!-- Modal Tambah Pengukuran -->
    <div class="modal fade" id="tambahPengukuranModal" tabindex="-1" aria-labelledby="tambahPengukuranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPengukuranModalLabel">Tambah Pengukuran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="tanggalPengukuran" class="form-label">Tanggal Pengukuran</label>
                            <input type="date" class="form-control" id="tanggalPengukuran" required>
                        </div>
                        <div class="mb-3">
                            <label for="beratBadan" class="form-label">Berat Badan (kg)</label>
                            <input type="number" step="0.1" class="form-control" id="beratBadan" required>
                        </div>
                        <div class="mb-3">
                            <label for="tinggiBadan" class="form-label">Tinggi Badan (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="tinggiBadan" required>
                        </div>
                        <div class="mb-3">
                            <label for="lingkarKepala" class="form-label">Lingkar Kepala (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="lingkarKepala" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-primary">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="fileImport" class="form-label">Pilih File</label>
                            <input type="file" class="form-control" id="fileImport" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-success">IMPORT</button>
                </div>
            </div>
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
                    <form>
                        <!-- Dropdown Bulan -->
                        <div class="mb-3">
                            <label for="filterBulan" class="form-label">Bulan</label>
                            <select class="form-select" id="filterBulan">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <!-- Input Tahun -->
                        <div class="mb-3">
                            <label for="filterTahun" class="form-label">Tahun</label>
                            <input type="number" class="form-control" id="filterTahun" min="2000" max="2099" value="{{ date('Y') }}">
                        </div>
    

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-primary">FILTER</button>
                </div>
            </div>
        </div>
    </div>
@endsection