@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Data Faktor</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Data Faktor Stunting</div>
                <div>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambahFaktorModal">
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

            <!-- Tabel Data Faktor -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Faktor</th>
                            <th>Nama Faktor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>FR001</td>
                            <td>Berat Badan Lahir Rendah</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm edit-faktor" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editFaktorModal"
                                        data-id="1"
                                        data-kode="FR001"
                                        data-nama="Berat Badan Lahir Rendah (<2500 gram)">
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
                            <td>FR002</td>
                            <td>ASI Eksklusif</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm edit-faktor"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editFaktorModal"
                                        data-id="2"
                                        data-kode="FR002"
                                        data-nama="Tidak Mendapat ASI Eksklusif">
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
                            <td>FR003</td>
                            <td>Pengetahuan Ibu</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm edit-faktor"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editFaktorModal"
                                        data-id="3"
                                        data-kode="FR003"
                                        data-nama="Pengetahuan Ibu tentang Gizi Rendah">
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
                            <td>FR004</td>
                            <td>Pendapatan Keluarga</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm edit-faktor"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editFaktorModal"
                                        data-id="4"
                                        data-kode="FR004"
                                        data-nama="Pendapatan Keluarga < Rp2.000.000/bulan">
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
                            <td>FR005</td>
                            <td>Nilai Z-Score</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning btn-sm edit-faktor"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editFaktorModal"
                                        data-id="4"
                                        data-kode="FR004"
                                        data-nama="Nilai Z-Score">
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
                Showing <span>1</span> to <span>4</span> of <span>4</span> entries
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

    <!-- Modal Tambah Faktor -->
    <div class="modal fade" id="tambahFaktorModal" tabindex="-1" aria-labelledby="tambahFaktorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahFaktorModalLabel">Tambah Faktor Resiko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode_faktor" class="form-label">Kode Faktor</label>
                            <input type="text" class="form-control" id="kode_faktor" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_faktor" class="form-label">Nama Faktor</label>
                            <input type="text" class="form-control" id="nama_faktor" required>
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

    <!-- Modal Edit Faktor -->
    <div class="modal fade" id="editFaktorModal" tabindex="-1" aria-labelledby="editFaktorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFaktorModalLabel">Edit Faktor Resiko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id">
                        <div class="mb-3">
                            <label for="edit_kode_faktor" class="form-label">Kode Faktor</label>
                            <input type="text" class="form-control" id="edit_kode_faktor" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_faktor" class="form-label">Nama Faktor</label>
                            <input type="text" class="form-control" id="edit_nama_faktor" required>
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle edit button click
        $('.edit-faktor').click(function() {
            var id = $(this).data('id');
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');
            
            $('#edit_id').val(id);
            $('#edit_kode_faktor').val(kode);
            $('#edit_nama_faktor').val(nama);
        });

        // Reset form tambah saat modal ditutup
        $('#tambahFaktorModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
        });
    });
</script>
@endpush