@extends('layouts.petugas_puskesmas')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Detail Hasil Screening</li>

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Detail Hasil Screening</div>
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
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Nama Balita</th>
                        <th style="width: 25%;">BB/U</th>
                        <th style="width: 25%;">TB/U</th>
                        <th style="width: 25%;">BB/TB</th>
                        <th style="width: 25%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ani</td>
                        <td><button class="btn-custom-normal">Gizi Baik</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Budi</td>
                        <td><button class="btn-custom-stunting">Gizi Kurang</button></td>
                        <td><button class="btn-custom-stunting">Pendek</button></td>
                        <td><button class="btn-custom-stunting">Kurus</button></td>
                        <td><button class="btn-custom-stunting">Stunting</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Cici</td>
                        <td><button class="btn-custom-sangatstunting">Gizi Buruk</button></td>
                        <td><button class="btn-custom-sangatstunting">Sangat Pendek</button></td>
                        <td><button class="btn-custom-sangatstunting">Sangat Kurus</button></td>
                        <td><button class="btn-custom-sangatstunting">Sangat Stunting</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Dedi</td>
                        <td><button class="btn-custom-normal">Gizi Lebih</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                        <td><button class="btn-custom-normal">Gemuk</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Eka</td>
                        <td><button class="btn-custom-stunting">Gizi Kurang</button></td>
                        <td><button class="btn-custom-stunting">Pendek</button></td>
                        <td><button class="btn-custom-stunting">Kurus</button></td>
                        <td><button class="btn-custom-stunting">Stunting</button></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Fani</td>
                        <td><button class="btn-custom-normal">Gizi Baik</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Gani</td>
                        <td><button class="btn-custom-sangatstunting">Gizi Buruk</button></td>
                        <td><button class="btn-custom-sangatstunting">Sangat Pendek</button></td>
                        <td><button class="btn-custom-sangatstunting">Sangat Kurus</button></td>
                        <td><button class="btn-custom-sangatstunting">Sangat Stunting</button></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Hani</td>
                        <td><button class="btn-custom-normal">Gizi Lebih</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                        <td><button class="btn-custom-normal">Gemuk</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Ina</td>
                        <td><button class="btn-custom-stunting">Gizi Kurang</button></td>
                        <td><button class="btn-custom-stunting">Pendek</button></td>
                        <td><button class="btn-custom-stunting">Kurus</button></td>
                        <td><button class="btn-custom-stunting">Stunting</button></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Joni</td>
                        <td><button class="btn-custom-normal">Gizi Baik</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
                        <td><button class="btn-custom-normal">Normal</button></td>
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
                            <input type="number" class="form-control" id="filterTahun" min="2000" max="2099"
                                value="{{ date('Y') }}">
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
