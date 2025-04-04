@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Data Aturan</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Data Aturan</div>
                <div>
                    <a href="{{ route('admin.data-aturan.create') }}" class="btn btn-info">
                        <i class="fas fa-plus"></i> TAMBAH
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Filter dan Search -->
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <!-- Dropdown Show Entries -->
                <div class="d-flex align-items-center">
                    <label for="showEntries" class="me-2">Show</label>
                    <select class="form-select form-select-sm w-auto" id="showEntries">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
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

            <!-- Tabel Data Faktor -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Aturan</th>
                            <th>Aturan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dummy Data Rules in IF-THEN format -->
                        <tr>
                            <td>1</td>
                            <td>R001</td>
                            <td>
                                <strong>IF</strong> Z-Score = Rendah <strong>AND</strong> Berat Badan Lahir = Rendah
                                <strong>AND</strong> ASI Eksklusif = Tidak <strong>AND</strong> Pengetahuan Ibu = Rendah
                                <strong>AND</strong> Pendapatan Keluarga = Rendah <br>
                                <strong>THEN</strong> Keputusan = Stunting
                            </td>
                            <td class="align-middle">
                                <div class="d-flex gap-1">
                                    <a href="#" class="btn btn-sm btn-warning text-white" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>R002</td>
                            <td>
                                <strong>IF</strong> Z-Score = Normal <strong>AND</strong> Berat Badan Lahir = Normal
                                <strong>AND</strong> ASI Eksklusif = Ya <strong>AND</strong> Pengetahuan Ibu = Tinggi
                                <strong>AND</strong> Pendapatan Keluarga = Tinggi <br>
                                <strong>THEN</strong> Keputusan = Tidak Stunting
                            </td>
                            <td class="align-middle">
                                <div class="d-flex gap-1">
                                    <a href="#" class="btn btn-sm btn-warning text-white" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>R003</td>
                            <td>
                                <strong>IF</strong> Z-Score = Rendah <strong>AND</strong> Berat Badan Lahir = Normal
                                <strong>AND</strong> ASI Eksklusif = Ya <strong>AND</strong> Pengetahuan Ibu = Sedang
                                <strong>AND</strong> Pendapatan Keluarga = Menengah <br>
                                <strong>THEN</strong> Keputusan = Beresiko Stunting
                            </td>
                            <td class="align-middle">
                                <div class="d-flex gap-1">
                                    <a href="#" class="btn btn-sm btn-warning text-white" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>R004</td>
                            <td>
                                <strong>IF</strong> Z-Score = Normal <strong>AND</strong> Berat Badan Lahir = Rendah
                                <strong>AND</strong> ASI Eksklusif = Tidak <strong>AND</strong> Pengetahuan Ibu = Rendah
                                <strong>AND</strong> Pendapatan Keluarga = Rendah <br>
                                <strong>THEN</strong> Keputusan = Stunting
                            </td>
                            <td class="align-middle">
                                <div class="d-flex gap-1">
                                    <a href="#" class="btn btn-sm btn-warning text-white" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Info Pagination -->
            <div class="mt-3">
                Showing <span>1</span> to <span>4</span> of <span>4</span> entries
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item">
                        <a class="page-link text-primary" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
