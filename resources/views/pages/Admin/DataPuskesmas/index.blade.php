@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Data Puskesmas</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Data Puskesmas</div>
                <div>
                    <a href="{{ route('admin.data-puskesmas.create') }}" class="btn btn-info">
                    <i class="fas fa-plus me-1"></i> TAMBAH
                </a>
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
                        <th>Nama Puskesmas</th>
                        <th>Kecamatan</th>
                        <th>Desa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($puskesmas as $index => $datapuskesmas)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $datapuskesmas->nama_puskesmas }}</td>
                            <td>{{ $datapuskesmas->kecamatan->name ?? 'Tidak ada kecamatan' }}</td>
                            <td>{{ $datapuskesmas->desa->name ?? 'Tidak ada desa' }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editPuskesmasModal{{ $datapuskesmas->id }}">
                                    <i class="fas fa-edit text-white"></i>
                                </button>
                                <form action="{{ route('admin.data-puskesmas.destroy', $datapuskesmas->id) }}"
                                    method="POST" style="display:inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @include('pages.Admin.DataPuskesmas.edit', [
                            'datapuskesmas' => $datapuskesmas,
                            'kecamatans' => $kecamatans,
                        ])
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

@endsection
