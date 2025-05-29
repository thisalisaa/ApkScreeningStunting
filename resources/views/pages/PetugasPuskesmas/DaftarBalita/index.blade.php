@extends('layouts.petugas_puskesmas')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Daftar Balita</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Daftar Balita</div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('petugas-puskesmas.daftar-balita') }}"
                class="mb-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <label for="per_page" class="me-2">Show</label>
                    <select name="per_page" id="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="ms-2">entries</span>
                </div>

                <div class="input-group w-25">
                    <input type="text" name="search" class="form-control" placeholder="Cari..."
                        value="{{ $search }}">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Posyandu</th>
                            <th>Desa</th>
                            <th>Jumlah Balita</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posyandus as $index => $posyandu)
                            <tr>
                                <td>{{ $posyandus->firstItem() + $index }}</td>
                                <td>{{ $posyandu->nama_posyandu }}</td>
                                <td>{{ $posyandu->desa->name ?? '-' }}</td>
                                <td>{{ $posyandu->balita_count }}</td>
                                <td>
                                    <a href="{{ route('petugas-puskesmas.daftar-balita.show', $posyandu->id) }}"
                                        class="btn btn-sm btn-primary" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing {{ $posyandus->firstItem() }} to {{ $posyandus->lastItem() }} of {{ $posyandus->total() }}
                    entries
                </div>
                <div>
                    {{ $posyandus->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
