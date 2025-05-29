@extends('layouts.admin')

@section('title', 'APK-Screening - Data Posyandu')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Data Posyandu</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Data Posyandu</h5>
                <a href="{{ route('admin.data-posyandu.create') }}" class="btn btn-info">
                    <i class="fas fa-plus me-1"></i> TAMBAH
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between align-items-center">
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

                <div class="input-group w-25">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari...">
                    <button class="btn btn-info" type="button" id="searchButton">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Posyandu</th>
                            <th>Puskesmas</th>
                            <th>Kecamatan</th>
                            <th>Desa</th> 
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posyandus as $index => $dataposyandu)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $dataposyandu->nama_posyandu }}</td>
                        <td>{{ $dataposyandu->puskesmas->nama_puskesmas}}</td>
                        <td>{{ $dataposyandu->kecamatan->name ?? 'Tidak ada kecamatan' }}</td>
                        <td>{{ $dataposyandu->desa->name ?? 'Tidak ada desa' }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit text-white"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="dataTables_info">
                        Showing <span id="startEntry">1</span> to <span id="endEntry">3</span> of <span id="totalEntries">3</span> entries
                    </div>
                </div>
                <div class="col-md-6">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

