@extends('layouts.petugas_puskesmas')

@section('title', 'APK-Screening')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Data Pengukuran</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-title">Laporan Pengukuran - </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('petugas-puskesmas.laporan-pengukuran.verifikasi') }}" method="POST">
                @csrf
                @method('PUT')

                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 15%;">Nama Balita</th>
                            <th style="width: 10%;">Usia (bulan)</th>
                            <th style="width: 15%;">Tanggal Pengukuran</th>
                            <th style="width: 10%;">BB (kg)</th>
                            <th style="width: 10%;">TB (cm)</th>
                            <th style="width: 20%;">Catatan</th>
                            <th style="width: 10%;">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataPengukuran as $index => $data)
                            <tr>
                                <td>{{ $dataPengukuran->firstItem() + $index }}</td>
                                <td>{{ $data->balita->nama_balita }}</td>
                                <td>{{ $data->usia_bulan }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_pengukuran)->format('d-m-Y') }}</td>
                                <td>{{ $data->berat_badan }}</td>
                                <td>{{ $data->tinggi_badan }}</td>
                                <td>
                                    <input type="hidden" name="ids[]" value="{{ $data->id }}">
                                    <input type="text" name="catatan[{{ $data->id }}]" value="{{ $data->catatan }}"
                                        class="form-control" placeholder="Tulis catatan...">
                                </td>
                                <td>
                                    <a href="{{ route('petugas-puskesmas.laporan-pengukuran.detail', $data->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data pengukuran untuk diverifikasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @php
                    // Cek apakah ada status to review
                    $adaToReview = $dataPengukuran->contains(function ($item) {
                        return $item->status_verifikasi === 'to review';
                    });
                @endphp

                @if ($adaToReview)
                    @if ($dataPengukuran->count())
                        <button type="submit" name="action" value="verifikasi" class="btn btn-success">
                            VERIFIKASI
                        </button>
                        <button type="submit" name="action" value="rejected" class="btn btn-danger">
                            REJECTED
                        </button>
                    @endif
                @else
                    {{-- Jika tidak ada to review, tampilkan info diverifikasi --}}
                    <div class="col-sm-3">
                        <p class="text-center">Diverifikasi oleh,</p>
                        <p class="text-center text-success">
                            @php
                                // Ambil status dari data pertama sebagai contoh, sesuaikan jika perlu
                                $status = $dataPengukuran->first()->status_verifikasi ?? null;
                                $pengukuran = $dataPengukuran->first();
                            @endphp

                            @if ($status == 'verified')
                                <i class="fa fa-check-circle fa-4x"></i>
                            @elseif ($status == 'rejected')
                                <i class="fa fa-times-circle fa-4x" style="color: red;"></i>
                            @else
                                <i class="fa fa-times-circle fa-4x" style="color: red;"></i>
                            @endif
                        </p>

                        <p class="text-center">
                            @if (in_array($status, ['verified', 'rejected']))
                                {{ $pengukuran->user->nama ?? '-' }}<br>
                                {{ $pengukuran->verified_at ? \Carbon\Carbon::parse($pengukuran->verified_at)->format('Y-m-d H:i:s') : '-' }}
                                <br>
                            @endif
                        </p>
                    </div>
                @endif

            </form>
        </div>
    </div>
@endsection
