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
            <!-- Drop down perpage dan Search -->
            <form method="GET" action="{{ route('admin.data-faktor') }}"
                class="mb-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <label for="show" class="me-2">Show</label>
                    <select class="form-select form-select-sm w-auto" name="show" id="show"
                        onchange="this.form.submit()">
                        <option value="5" {{ request('show') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('show') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('show') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('show') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('show') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="ms-2">entries</span>
                </div>

                <div class="input-group w-25">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Cari...">
                    <button class="btn btn-info" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>


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
                        @forelse ($faktor as $index => $daftarfaktor)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $daftarfaktor->kode_faktor }}</td>
                                <td>{{ $daftarfaktor->nama_faktor }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm btn-edit-faktor"
                                        data-id="{{ $daftarfaktor->id }}" data-kode="{{ $daftarfaktor->kode_faktor }}"
                                        data-nama="{{ $daftarfaktor->nama_faktor }}" data-bs-toggle="modal"
                                        data-bs-target="#editFaktorModal">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                    <form action="{{ route('admin.data-faktor.destroy', $daftarfaktor->id) }}"
                                        method="POST" class="d-inline form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger btn-hapus"
                                            data-nama="{{ $daftarfaktor->nama_faktor }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No data available in table.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Info Pagination -->
            <div class="mt-3">
                Showing <span>{{ $faktor->firstItem() }}</span> to <span>{{ $faktor->lastItem() }}</span> of
                <span>{{ $faktor->total() }}</span> entries
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

    @include('pages.Admin.DataFaktor.create')
    @include('pages.Admin.DataFaktor.edit')


@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hapusButtons = document.querySelectorAll('.btn-hapus');

            hapusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.form-hapus');
                    const nama = this.getAttribute('data-nama');

                    Swal.fire({
                        title: `Hapus data faktor?`,
                        text: `Faktor "${nama}" akan dihapus secara permanen.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
