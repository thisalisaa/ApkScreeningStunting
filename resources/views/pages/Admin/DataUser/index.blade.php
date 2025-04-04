@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Data User</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Data User</div>
                <div>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
                        <i class="fas fa-plus"></i> TAMBAH
                    </button>
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

            <!-- Tabel Data User -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Posyandu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Dummy -->
                        <tr>
                            <td>1</td>
                            <td>Admin Utama</td>
                            <td>admin@apk-screening.com</td>
                            <td>-</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm edit-user" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Dr. Siti Rahayu</td>
                            <td>siti.rahayu@puskesmas.com</td>
                            <td>Posyandu Lohbener</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm edit-user" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Budi Santoso</td>
                            <td>budi.santoso@puskesmas.com</td>
                            <td>Posyandu Indramayu</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm edit-user" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Ani Wijaya</td>
                            <td>Belum Verifikasi Email</td>
                            <td>Posyandu Jatibarang</td>
                            <td><span class="badge bg-danger">Inactive</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm edit-user" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Rina Amelia</td>
                            <td>rina.amelia@puskesmas.com</td>
                            <td>Posyandu Kandanghaur</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm edit-user" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Info Pagination -->
            <div class="mt-3">
                Showing <span>1</span> to <span>5</span> of <span>5</span> entries
            </div>

            <!-- Pagination -->
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

    <!-- Modal Tambah User -->
    <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahUserModalLabel">Tambah User </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_puskesmas" class="form-label">Posyandu</label>
                            <select class="form-select" id="edit_puskesmas">
                                <option value="1" selected>Posyandu Lohbener</option>
                                <option value="2">Posyandu Indramayu</option>
                                <option value="3">Posyandu Jatibarang</option>
                                <option value="4">Posyandu Kandanghaur</option>
                                <option value="5">Posyandu Sliyeg</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="puskesmas" class="form-label">Puskesmas</label>
                            <select class="form-select" id="puskesmas">
                                <option value="" selected disabled>Pilih Puskesmas</option>
                                <option value="1">Puskesmas Lohbener</option>
                                <option value="2">Puskesmas Indramayu</option>
                                <option value="3">Puskesmas Jatibarang</option>
                                <option value="4">Puskesmas Kandanghaur</option>
                                <option value="5">Puskesmas Sliyeg</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                        <button type="button" class="btn btn-success">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit_name" value="Dr. Siti Rahayu" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" value="siti.rahayu@puskesmas.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                            <input type="password" class="form-control" id="edit_password">
                        </div>
                        <div class="mb-3">
                            <label for="edit_puskesmas" class="form-label">Posyandu</label>
                            <select class="form-select" id="edit_puskesmas">
                                <option value="1" selected>Posyandu Lohbener</option>
                                <option value="2">Posyandu Indramayu</option>
                                <option value="3">Posyandu Jatibarang</option>
                                <option value="4">Posyandu Kandanghaur</option>
                                <option value="5">Posyandu Sliyeg</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit_puskesmas" class="form-label">Puskesmas</label>
                            <select class="form-select" id="edit_puskesmas">
                                <option value="1" selected>Puskesmas Lohbener</option>
                                <option value="2">Puskesmas Indramayu</option>
                                <option value="3">Puskesmas Jatibarang</option>
                                <option value="4">Puskesmas Kandanghaur</option>
                                <option value="5">Puskesmas Sliyeg</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                        <button type="button" class="btn btn-warning text-white">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

