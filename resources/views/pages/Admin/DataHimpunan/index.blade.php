@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Data Himpunan</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Data Himpunan</div>
                <div>
                    <a href="{{ route('admin.data-himpunan.create') }}" class="btn btn-info">
                        <i class="fas fa-plus"></i> TAMBAH
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <!-- Dropdown Show Entries -->
                <div class="d-flex align-items-center">
                    <label for="showEntries" class="me-2">Show</label>
                    <form method="GET" id="perPageForm">
                        <select class="form-select form-select-sm w-auto" id="showEntries" name="per_page"
                            onchange="this.form.submit()">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                    <span class="ms-2">entries</span>
                </div>

                <!-- Search Input -->
                <div class="input-group w-25">
                    <form action="{{ route('admin.data-himpunan') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari...">
                        <button class="btn btn-info" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Faktor Stunting</th>
                            <th>Himpunan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataHimpunan as $index => $item)
                            <tr>
                                <td>{{ $dataHimpunan->firstItem() + $index }}</td>
                                <td>{{ $item->faktor->nama_faktor ?? '-' }}</td>
                                <td>{{ $item->nama_himpunan }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.data-himpunan.show', $item->id) }}"
                                            class="btn btn-sm btn-primary" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.data-himpunan.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit text-white"></i>
                                        </a>
                                        <form action="{{ route('admin.data-himpunan.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div>
                Showing {{ $dataHimpunan->firstItem() ?? 0 }} to {{ $dataHimpunan->lastItem() ?? 0 }} of {{ $dataHimpunan->total() }}
                entries
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end">
                    <li class="page-item {{ $dataHimpunan->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $dataHimpunan->previousPageUrl() ?? '#' }}" tabindex="-1"
                            aria-disabled="{{ $dataHimpunan->onFirstPage() ? 'true' : 'false' }}">
                            Previous
                        </a>
                    </li>
                    @foreach ($dataHimpunan->getUrlRange(1, $dataHimpunan->lastPage()) as $page => $url)
                        <li class="page-item {{ $dataHimpunan->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item {{ !$dataHimpunan->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $dataHimpunan->nextPageUrl() ?? '#' }}"
                            aria-disabled="{{ !$dataHimpunan->hasMorePages() ? 'true' : 'false' }}">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>




@endsection
