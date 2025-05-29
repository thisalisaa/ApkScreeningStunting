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
                    <a href="{{ route('admin.data-user.create') }}" class="btn btn-info">
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
                    <select class="form-select form-select-sm w-auto" id="showEntries">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="ms-2">entries</span>
                </div>

                <!-- Search Input -->
                <div class="input-group w-25">
                    <form action="{{ route('admin.data-user') }}" method="GET" class="d-flex w-100">
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
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Puskesmas</th>
                            <th>Posyandu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->puskesmas->nama_puskesmas ?? '-' }}</td>
                                <td>{{ $user->posyandus->nama_posyandu ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->email_verified_at ? 'success' : 'danger' }}">
                                        {{ $user->email_verified_at ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>                                    
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.data-user', $user->id) }}"
                                            class="btn btn-primary btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.data-user', $user->id) }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit text-white"></i>
                                        </a>
                                        <form action="{{ route('admin.data-user', $user->id) }}"
                                            method="POST" class="d-inline form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger btn-hapus"
                                                data-nama="{{ $user->nama }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data user.</td>
                            </tr>
                        @endforelse
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

@endsection
