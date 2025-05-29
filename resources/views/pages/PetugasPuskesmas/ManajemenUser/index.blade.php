@extends('layouts.petugas_puskesmas')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Manajemen User</div>
                <div>
                    <a href="{{ route('petugas-puskesmas.manajemen-user.create') }}" class="btn btn-info">
                        <i class="fas fa-plus"></i> TAMBAH
                    </a>
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
                        <th>Nama Petugas</th>
                        <th>Email</th>
                        <th>Posyandu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
               <tbody>
                <tr>
                    <td>1</td>
                    <td>Alisa</td>
                    <td>alisa@gmail.com</td>
                    <td>Posyandu Mawar</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit text-white"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ayu</td>
                    <td>alisa1211@gmail.com</td>
                    <td>Posyandu Melati</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit text-white"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
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


@endsection
