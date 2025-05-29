@extends('layouts.petugas_posyandu')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Grafik Pertumbuhan</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Data Grafik Pertumbuhan</div>
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

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Balita</th>
                        <th>Usia (bulan)</th>
                        <th>Show</th>
                    </tr>
                </thead>
            <tbody>
                @foreach ($balitas as $index => $balita)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $balita->nama_balita }}</td>
                        <td>{{ $balita->usia }} bulan</td>
                        <td>
                            <a href="{{ route('petugas-posyandu.showGrafikTinggiBadan', $balita->id) }}"
                                        class="btn btn-primary btn-sm" title="Detail">
                                        <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            <div class="mt-3">
                Showing <span id="startEntry">1</span> to <span id="endEntry">5</span> of <span id="totalEntries">10</span>
                entries
            </div>

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


    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
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
                        <div class="mb-3">
                            <label for="filterTahun" class="form-label">Tahun</label>
                            <input type="number" class="form-control" id="filterTahun" min="2000" max="2099"
                                value="{{ date('Y') }}">
                        </div>
                        <div class="mb-3">
                            <label for="filterStatus" class="form-label">Status</label>
                            <select class="form-select" id="filterStatus">
                                <option value="">All</option>
                                <option value="normal">Normal</option>
                                <option value="stunting">Stunting</option>
                                <option value="severely">Severely Stunting</option>
                            </select>
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
