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
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambahPuskesmasModal">
                        <i class="fas fa-plus"></i> TAMBAH
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
                        <th>Kode Puskesmas</th>
                        <th>Nama Puskesmas</th>
                        <th>Kecamatan</th>
                        <th>Desa</th> 
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>PKM001</td>
                        <td>Puskesmas Lohbener</td>
                        <td>Lohbener</td>
                        <td>Lohbener</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit text-white"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger">
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

    <div class="modal fade" id="tambahPuskesmasModal" tabindex="-1" aria-labelledby="tambahPuskesmasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPuskesmasModalLabel">Tambah Data Puskesmas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahPuskesmas">
                        <div class="mb-3">
                            <label for="kodePuskesmas" class="form-label">Kode Puskesmas</label>
                            <input type="text" class="form-control" id="kodePuskesmas" required>
                        </div>
                        <div class="mb-3">
                            <label for="namaPuskesmas" class="form-label">Nama Puskesmas</label>
                            <input type="text" class="form-control" id="namaPuskesmas" required>
                        </div>
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select class="form-select" id="kecamatan" required>
                                <option value="" selected disabled>Pilih Kecamatan</option>
                                <option value="Lohbener">Lohbener</option>
                                <option value="Indramayu">Indramayu</option>
                                <option value="Jatibarang">Jatibarang</option>
                                <option value="Kandanghaur">Kandanghaur</option>
                                <option value="Sliyeg">Sliyeg</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="desa" class="form-label">Desa</label>
                            <select class="form-select" id="desa" required>
                                <option value="" selected disabled>Pilih Desa</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-success" id="simpanPuskesmas">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const desaByKecamatan = {
            'Lohbener': ['Lohbener', 'Segeran', 'Segeran Kidul', 'Waru', 'Anjatan'],
            'Indramayu': ['Indramayu', 'Pabean Udik', 'Dukuh', 'Karangsong', 'Lemahabang'],
            'Jatibarang': ['Jatibarang', 'Bulak', 'Jatibarang Baru', 'Kebulen', 'Pawidean'],
            'Kandanghaur': ['Kandanghaur', 'Brondong', 'Soge', 'Karanganyar', 'Sleman'],
            'Sliyeg': ['Sliyeg', 'Gadingan', 'Longok', 'Majasari', 'Majasih']
        };

        $('#kecamatan').change(function() {
            const selectedKecamatan = $(this).val();
            const desaDropdown = $('#desa');
            
            desaDropdown.empty();
            desaDropdown.append('<option value="" selected disabled>Pilih Desa</option>');
            
            if (selectedKecamatan && desaByKecamatan[selectedKecamatan]) {
                desaByKecamatan[selectedKecamatan].forEach(function(desa) {
                    desaDropdown.append(`<option value="${desa}">${desa}</option>`);
                });
            }
        });

        $('#simpanPuskesmas').click(function() {
            if ($('#formTambahPuskesmas')[0].checkValidity()) {
                alert('Data puskesmas berhasil disimpan!');
                $('#tambahPuskesmasModal').modal('hide');
                $('#formTambahPuskesmas')[0].reset();
                $('#desa').empty().append('<option value="" selected disabled>Pilih Desa</option>');
            } else {
                $('#formTambahPuskesmas')[0].reportValidity();
            }
        });
    });
</script>
@endpush