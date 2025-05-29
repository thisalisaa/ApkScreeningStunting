@extends('layouts.admin')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Data Aturan</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Data Aturan</div>
                <div>
                    <a href="{{ route('admin.data-aturan.create') }}" class="btn btn-info">
                        <i class="fas fa-plus"></i> TAMBAH
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Filter dan Search -->
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

            <!-- Tabel Data Aturan -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Aturan</th>
                            <th>Aturan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataAturans as $index => $aturan)
                            <tr>
                                <td>{{ $dataAturans->firstItem() + $index }}</td>
                                <td>{{ $aturan->kode_aturan }}</td>
                                <td>
                                    @php
                                        $aturanList = json_decode($aturan->nilai_faktor, true);
                                    @endphp

                                    @if ($aturanList)
                                        <strong>IF</strong>
                                        @foreach ($aturanList as $kode => $nilai)
                                            {{ $faktors[$kode] ?? $kode }} = <strong>{{ $nilai }}</strong>
                                            @if (!$loop->last)
                                                <strong>AND</strong>
                                            @endif
                                        @endforeach
                                        <br>
                                        <strong>THEN</strong> Status Gizi = <strong>{{ $aturan->keputusan }}</strong>
                                    @endif
                                </td>

                                <td class="align-middle">
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.data-aturan.edit', $aturan->id) }}"
                                            class="btn btn-sm btn-warning text-white" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.data-aturan.destroy', $aturan->id) }}" method="POST"
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
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data aturan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Info Pagination -->
            <div class="mt-3">
                Menampilkan {{ $dataAturans->firstItem() }} sampai {{ $dataAturans->lastItem() }} dari total
                {{ $dataAturans->total() }} data
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end">
                {{ $dataAturans->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
